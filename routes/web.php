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
Route::get('/', 'ProductController@home');
Route::get('/view/{id}', 'ProductController@view');
Route::get('/products', 'ProductController@index');
Route::get('/details/{id}', 'ProductController@details');
Route::get('/create', 'ProductController@create');
Route::get('/edit/{id}', 'ProductController@edit');

