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

use Cornford\Googlmapper\Facades\MapperFacade;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('map');
});

Route::get('/map-arc', function () {
    return view('map-arc');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/map' , function () {
   Mapper::map(
       53.3,
       -1.4,
       [
           'zoom' => 16,
           'draggable' => true,
           'marker' => false,
           'eventAfterLoad' =>
           'circleListener(maps[0].shapes[0].circle_0);'
       ]

   );
   print '<div style="height: 400px; width: 400px;">';
   print Mapper::render();
   print '</div>';


});
