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

Route::group([
    'namespace' => 'API',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});
//this group handles the users authentication system
Route::group([
    //this prefix means the api will be yourdomain.com/auth/{any of the routes inside this group}
    'prefix' => 'auth'
    //inside this function all auth routes that the user can use before login/register
], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');
    Route::get('register/activate/{token}', 'API\AuthController@registerActivate');
    //inside this group all apis that need a user level role to access
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'API\AuthController@logout');
        //user route will return a response with user info, addresses, and a boutique info if exists.
        Route::get('user', 'API\UserController@userInfo');
    });
});
Route::get('register/activate/{token}', 'API\AuthController@registerActivate');

