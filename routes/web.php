<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    
    Route::get('/realm/{id}', 'RealmController@show');
    Route::get('/land/{id}', 'LandController@show');
    
    Route::post('/newCity', 'CityController@create');
    
    Route::post('/newBuilding', 'CityController@newBuilding');
    Route::post('/demolishBuilding', 'CityController@demolishBuilding');
});
