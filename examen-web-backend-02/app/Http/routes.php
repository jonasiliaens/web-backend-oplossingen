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

Route::get('/', 'PagesController@index');
Route::get('dashboard', 'PagesController@dashboard');
Route::get('todos', 'TodosController@todos');
Route::get('todos/add', 'TodosController@add');
Route::get('todos/toggle/{id}', 'TodosController@toggle');
Route::get('todos/delete/{id}', 'TodosController@delete');
Route::post('todos', 'TodosController@store');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
