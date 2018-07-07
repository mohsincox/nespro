<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/test', 'HomeController@test');

Route::get('division', 'DivisionController@index');
Route::get('division/create', 'DivisionController@create');
Route::post('division', 'DivisionController@store');
Route::get('division/{id}/edit', 'DivisionController@edit');
Route::put('division/{id}', 'DivisionController@update');

Route::get('district', 'DistrictController@index');
Route::get('district/create', 'DistrictController@create');
Route::post('district', 'DistrictController@store');
Route::get('district/{id}/edit', 'DistrictController@edit');
Route::put('district/{id}', 'DistrictController@update');

Route::get('testing', 'PoliceStationController@testing');
Route::get('division-district-show', 'PoliceStationController@divisionDistrictShow');

Route::get('police-station', 'PoliceStationController@index');
Route::get('police-station/create', 'PoliceStationController@create');
Route::post('police-station', 'PoliceStationController@store');
Route::get('police-station/{id}/edit', 'PoliceStationController@edit');
Route::put('police-station/{id}', 'PoliceStationController@update');