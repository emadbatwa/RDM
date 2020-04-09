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

Route::get('/home', 'TicketController@list')->name('home');

Route::group([
    'prefix' => 'ticket',
    'middleware' => 'auth',
], function () {
    Route::get('show/{ticket_id}', 'TicketController@show');
    Route::post('update', 'TicketController@update');
});
Route::group([
    'prefix' => 'user',
    'middleware' => 'auth',
], function () {
    Route::post('update', 'API\UserController@update');
});

