<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('item/all', 'Api\v1\ItemController@all');
Route::get('item/{id}', 'Api\v1\ItemController@find')->where('id', '[0-9]+');
Route::post('item/create', 'Api\v1\ItemController@create'); 
Route::patch('item/{id}', 'Api\v1\ItemController@update')->where('id', '[0-9]+');
Route::delete('item/{id}', 'Api\v1\ItemController@delete')->where('id', '[0-9]+');