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
Route::get('/', 'IndexController@index');

Route::get('/users', array('as' => 'users.index', 'uses' => 'UserController@index'));
Route::get('/users/{user}', array('as' => 'users.show', 'uses' => 'UserController@show'));
Route::post('/users', array('as' => 'users.store', 'uses' => 'UserController@store'));
Route::put('/users/{user}', array('as' => 'users.update', 'uses' => 'UserController@update'));

Route::get('/places', array('as' => 'places.index', 'uses' => 'PlaceController@index'));
Route::get('/places/{place}', array('as' => 'places.show', 'uses' => 'PlaceController@show'));