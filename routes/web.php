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
Route::group([
    'prefix' => 'public',
], function () {
    Route::get('/map', 'TicketController@publicMap');
    Route::get('show/{ticket_id}', 'TicketController@showPublic');
});
Route::group([
    'prefix' => 'ticket',
    'middleware' => 'auth',
], function () {
    Route::get('/list', 'TicketController@list');
    Route::get('/map', 'TicketController@map');
    Route::get('show/{ticket_id}', 'TicketController@show');
    Route::post('update', 'TicketController@update');
});
Route::group([
    'prefix' => 'user',
    'middleware' => 'auth',
], function () {
    Route::get('employees', 'UserController@employees');
    Route::get('cities', 'API\TicketController@cities');
    Route::get('neighborhoods', 'API\TicketController@neighborhoods');
});

