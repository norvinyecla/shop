<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/{id}', 'ProductController@details');
Route::post('/add', 'ProductController@add');
Route::put('/update/{id}', 'ProductController@update');
Route::delete('/delete/{id}', 'ProductController@delete');