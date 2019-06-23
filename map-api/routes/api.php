<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'power_station'], function(){
    Route::get('/all', 'PowerStationController@get_all_power_stations');

});

Route::group(['prefix'=>'charging_station'], function(){
    Route::get('/all', 'ChargingStationController@get_all_charging_stations');
    Route::get('/{id}', 'ChargingStationController@get_charging_station_data');
});
