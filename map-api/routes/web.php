<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api_docs', function(){
    return view('api_docs.index');
})->name('overview');

Route::get('/api_docs/getting_started', function(){
    return view('api_docs.getting_started');
})->name('getting_started');

Route::get('/api_docs/api_calls', function(){
    return view('api_docs.api_calls');
})->name('api_calls');

Route::get('/api_docs/field_reference', function(){
    return view('api_docs.field_reference');
})->name('field_reference');

Route::get('/api_docs/faq', function(){
    return view('api_docs.faq');
})->name('faq');

Route::get('/api_docs/contact', function(){
    return view('api_docs.contact');
})->name('contact');

Route::get('/parse_ps', function(){
    return view('parse_ps');
})->name('contact');
Route::post('/parse_ps', 'PowerStationController@parse_ps')->name('parse_ps');

Route::get('/parse_cs', function(){
    return view('parse_cs');
})->name('contact');
Route::post('/parse_cs', 'ChargingStationController@parse_cs')->name('parse_cs');
Route::get('/find_nearest_ps', 'ChargingStationController@find_nearest_ps');
