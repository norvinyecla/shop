<?php

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

Route::get('/', 'ProductController@index');
Route::get('/{id}', 'ProductController@details');

Route::get('/create', 'ProductController@create');
Route::post('/add', 'ProductController@add');

Route::get('/{id}/edit', 'ProductController@edit');
Route::put('/{id}/update', 'ProductController@update');

Route::delete('{id}/delete', 'ProductController@delete');
