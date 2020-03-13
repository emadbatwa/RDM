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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'ticket',
    'middleware' => 'auth',
], function () {
    Route::post('create', 'API\TicketController@create');
    Route::get('list', 'API\TicketController@list');
    Route::post('update', 'API\TicketController@update');
    Route::post('rate', 'API\TicketController@rate');
    Route::get('cities', 'API\TicketController@cities');
    Route::get('neighborhoods', 'API\TicketController@neighborhoods');
    Route::post('show', 'API\TicketController@show');

});
Route::group([
    'prefix' => 'user',
    'middleware' => 'auth:api',
], function () {
    Route::post('update', 'API\UserController@update');
});

