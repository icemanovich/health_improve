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


Route::resource('/', 'IndexController');


Route::group(array('before' => 'auth'), function()
{
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    Route::resource('doctor', 'DoctorController');


//Route::resource('order', 'OrderController');
    Route::get('order/', 'OrderController@index');
    Route::get('order/date/{date}', 'OrderController@ordersByDate');
    Route::get('order/create', 'OrderController@create');
    Route::get('order/{time}', 'OrderController@show');    // create
    Route::post('order', 'OrderController@store');    // store (used for AJAX)
});

