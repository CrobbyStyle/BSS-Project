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

Route::get('/admin', 'RepositorioController@mostrarAdmin');

Route::get('/pusher', 'RepositorioController@index');
Route::post('/enviarParametros', 'RepositorioController@pushAlert');

Route::get('/notification', function () {
	return view('notification');
});

Route::post('/guardarConfiguracion', 'RepositorioController@guardarConfig');