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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('user', 'API\UserController@userInfo');
    });
});
Route::group([
    'prefix' => 'ticket',
    'middleware' => 'auth:api',
], function () {
    Route::post('create', 'API\TicketController@create');
    Route::get('list', 'API\TicketController@list');
    Route::post('update', 'API\TicketController@update');
    Route::post('rate', 'API\TicketController@rate');
    Route::get('cities', 'API\TicketController@cities');
    Route::get('neighborhoods', 'API\TicketController@neighborhoods');
    Route::post('show', 'API\TicketController@show');

});
