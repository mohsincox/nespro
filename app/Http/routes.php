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
Route::get('/test2', 'HomeController@test2');

Route::get('/division', 'DivisionController@index');
Route::get('/division/create', 'DivisionController@create');
Route::post('/division', 'DivisionController@store');
Route::get('/division/{id}/edit', 'DivisionController@edit');
Route::put('/division/{id}', 'DivisionController@update');

Route::get('/district', 'DistrictController@index');
Route::get('/district/create', 'DistrictController@create');
Route::post('/district', 'DistrictController@store');
Route::get('/district/{id}/edit', 'DistrictController@edit');
Route::put('/district/{id}', 'DistrictController@update');

Route::get('/testing', 'PoliceStationController@testing');
Route::get('/division-district-show', 'PoliceStationController@divisionDistrictShow');

Route::get('/police-station', 'PoliceStationController@index');
Route::get('/police-station/create', 'PoliceStationController@create');
Route::post('/police-station', 'PoliceStationController@store');
Route::get('/police-station/{id}/edit', 'PoliceStationController@edit');
Route::put('/police-station/{id}', 'PoliceStationController@update');

Route::get('/brand', 'BrandController@index');
Route::get('/brand/create', 'BrandController@create');
Route::post('/brand', 'BrandController@store');
Route::get('/brand/{id}/edit', 'BrandController@edit');
Route::put('/brand/{id}', 'BrandController@update');

Route::get('/product', 'ProductController@index');
Route::get('/product/create', 'ProductController@create');
Route::post('/product', 'ProductController@store');
Route::get('/product/{id}/edit', 'ProductController@edit');
Route::put('/product/{id}', 'ProductController@update');

Route::get('/select', 'SelectController@index');
Route::get('/select/create', 'SelectController@create');
Route::post('/select', 'SelectController@store');
Route::get('/select/{id}/edit', 'SelectController@edit');
Route::put('/select/{id}', 'SelectController@update');

Route::get('/option', 'OptionController@index');
Route::get('/option/create', 'OptionController@create');
Route::post('/option', 'OptionController@store');
Route::get('/option/{id}/edit', 'OptionController@edit');
Route::put('/option/{id}', 'OptionController@update');

Route::get('/crm-profile/division-district-show', 'CrmProfileController@divisionDistrictShow');
Route::get('/crm-profile/district-ps-show', 'CrmProfileController@districtPsShow');
Route::get('/crm-profile/get-ymd', 'CrmProfileController@getYMD');
Route::get('/crm-profile/brand-product-show', 'CrmProfileController@brandProductShow');
Route::get('/crm-profile/create', 'CrmProfileController@create');
Route::post('/crm-profile', 'CrmProfileController@store');