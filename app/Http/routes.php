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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', ['as' => 'main', 'uses' => 'Main@index']);
Route::get('/getrate', ['as' => 'getRate', 'uses' => 'Main@getRate']);
Route::any('/add', ['as' => 'addToSaves', 'uses' => 'Main@addToSaves']);