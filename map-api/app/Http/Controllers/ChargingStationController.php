<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargingStation;
use App\PowerStation;

class ChargingStationController extends Controller
{
    public function get_all_charging_stations(){
        $charging_stations = ChargingStation::select('charging_stations.*', 'power_stations.longitude as nearest_ps_long', 'power_stations.latitude as nearest_ps_lat')
                                ->join('power_stations', 'charging_stations.nearest_ps_id', 'power_stations.id')
                                ->get();
        return response()->json([
            'success' => true,
            'data' => $charging_stations
        ], 200);
    }



    public function get_charging_station_data($id){
        $charging_station = ChargingStation::select('charging_stations.*', 'power_stations.name as nearest_ps_type','power_stations.longitude as nearest_ps_long', 'power_stations.latitude as nearest_ps_lat')
            ->join('power_stations', 'charging_stations.nearest_ps_id', 'power_stations.id')
            ->where('charging_stations.id', $id)
            ->get();

        if (sizeof($charging_station) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Charging station with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $charging_station
        ], 200);
    }



    ////

    public function parse_cs(Request $request){
        $json = json_decode(file_get_contents($request->urlname), true);

        foreach( $json as $cs){
            ChargingStation::create([
                'longitude' => $cs["AddressInfo"]["Longitude"],
                'latitude' => $cs["AddressInfo"]["Latitude"],
                'name' => $cs["AddressInfo"]["Title"],
            ]);
        }
        return "ok";
    }

    public function find_nearest_ps(){
        $power_stations = PowerStation::all();
        $charging_stations = ChargingStation::all();

       $did = [];

        foreach( $charging_stations as $c_stn ){
            $id = $c_stn->id;
            $long = $c_stn->longitude;
            $lat = $c_stn->latitude;

           //if( $id == 4 ){

                $shortest_distance = [0,0];

                foreach( $power_stations as $p_stn){

                    $pid = $p_stn->id;
                    $plong = $p_stn->longitude;
                    $plat = $p_stn->latitude;

                    $distance = sqrt( pow( ($long - $plong) ,2) + pow( ( $lat - $plat ) ,2) );

                   array_push($did, [$distance, $pid]);

                    if( $shortest_distance[0] == 0 || $distance < $shortest_distance[0] ){
                        $shortest_distance = [ $distance, $pid ];
                    }
                }

                $this_c_stn = ChargingStation::find($id);
                $this_c_stn->nearest_ps_id = $shortest_distance[1];
                $this_c_stn->update();
           }
        //}
        //dd($did);
    }

    /////

}
