<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('post', 'PostController@getAll');
Route::get('post/{id}', 'PostController@getByID');
Route::post('post', 'PostController@create');
Route::patch('post/{id}', 'PostController@update');
Route::delete('post/{id}', 'PostController@delete');
