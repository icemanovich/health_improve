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


//Route::resource('doctors', 'DoctorController');
Route::get('doctor', 'DoctorController@index');
Route::get('doctor/{email}', 'DoctorController@show');


//Route::resource('order', 'OrderController');
Route::get('order', 'OrderController@index');
Route::get('order/create', 'OrderController@create');
//Route::get('order/{time}', 'OrderController@show');    // create
Route::post('order', 'OrderController@store');    // store (used for AJAX)

