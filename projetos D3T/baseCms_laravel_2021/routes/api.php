<?php

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

Route::middleware('cors')->group(function () {
    Route::get('/', function () {
        return response(['API' => 'Works'], 200);
    });

    Route::post('/upload', 'Api\TinyMceController@uploadImage');
    Route::post('/remove_media', 'Api\TinyMceController@removeImage');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});