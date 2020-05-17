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
	Route::get('public_map', 'TicketController@publicMap')->name('table');

    Route::get('/', function () {
        return view('auth.login');
    });

Auth::routes(['register' => false]);
Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::group([
    'middleware' => '',
], function () {
    Route::get('find_password', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});


Route::group([
    'prefix' => 'public',
], function () {
    Route::get('/map', 'TicketController@publicMap');
});
Route::group([
    'prefix' => 'ticket',
    'middleware' => 'auth',
], function () {
    Route::get('/list', 'TicketController@list')->name('ticket.list');
    Route::post('/update', 'TicketController@update')->name('ticket.update');
    Route::post('/updateClassification', 'TicketController@updateClassification')->name('ticket.updateClassification');
});
Route::group([
    'prefix' => 'user',
    'middleware' => 'auth',
], function () {
    Route::get('/employees', 'UserController@employees');
    Route::get('/add', 'UserController@add');
});

