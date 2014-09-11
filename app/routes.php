<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Auth Routes
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('check', 'AuthController@check');

Route::resource('user', 'UserController');
Route::resource('upload', 'UploadController');
