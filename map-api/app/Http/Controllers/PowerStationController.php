<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PowerStation;
use Illuminate\Support\Collection;

class PowerStationController extends Controller
{
    public function get_all_power_stations(){
        $power_stations = PowerStation::all();
        return response()->json([
            'success' => true,
            'data' => $power_stations
        ], 200);
    }

    public function parse_ps(Request $request){

        // $array = [];

        $handle = fopen($request->urlname, "r");
        $header = true;

        while ($csvLine = fgetcsv($handle, 1000, ",")) {

            if ($header) {
                $header = false;
            } else {
                // array_push($array, [
                //     'longitude' => $csvLine[0],
                //     'latitude' => $csvLine[2],
                //     'name' => $csvLine[6] == "" ? $csvLine[3] : $csvLine[6],
                // ]);
                PowerStation::create([
                    'longitude' => $csvLine[1],
                    'latitude' => $csvLine[2],
                    'name' => $csvLine[6] == "" ? $csvLine[3] : $csvLine[6],
                ]);
            }
        }
        return $request->urlname." ok";
    }
}
