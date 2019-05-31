<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PowerStation;

class PowerStationController extends Controller
{
    public function get_all_power_stations(){
        $power_stations = PowerStation::all();
        return response()->json([
            'success' => true,
            'data' => $power_stations
        ], 200);
    }
}
