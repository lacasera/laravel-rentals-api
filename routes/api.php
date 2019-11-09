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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Auth'], function(){
    Route::get('me', 'AuthController@me');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('register', 'RegisterController@create');
});

Route::group(['namespace' => 'Api\V1'], function () {
    Route::group(['middleware' => 'auth:api'], function (){
        Route::get('me/listings', 'UserListingController');
        Route::patch('properties/{id}/state', 'PropertyController@updateState');
        Route::apiResource('properties', 'PropertyController')->except(['show', 'index']);
        Route::post('properties/{id}/book', 'PropertyController@book');
    });
    Route::get('properties', 'PropertyController@index');
    Route::get('properties/{id}', 'PropertyController@show');
});

