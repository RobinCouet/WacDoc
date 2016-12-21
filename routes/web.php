<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
	Route::post('/files/create','FilesController@create');
	Route::resource('share', 'ShareController');
	Route::resource('messages', 'MessagesController');
	Route::get('/home', 'HomeController@index');
	Route::resource('files', 'FilesController');
	Route::get('/files/download/{id}/{type}', 'FilesController@download');
	Route::post('/files/download/{id}/{type}', 'FilesController@download');
});
Auth::routes();
Route::get('register/verify/{confirmationCode}', 'Auth\RegisterController@confirm');