<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WeatherController@index');

Route::get('/{name}', 'WeatherController@index')->name('index');

Route::get('/home', function () {
    return view('weather.index');
});

Route::get('/error', 'WeatherController@index');

Route::get('/{lat}/{lon}', 'WeatherController@getByCoordinates');