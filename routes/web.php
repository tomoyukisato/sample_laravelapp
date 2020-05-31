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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('video/stream', 'VideoController@stream');

Route::resource('posts', 'PostController');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/calendar', 'CalendarController@index');

Route::get('event/add','EventController@createEvent');
Route::post('event/add','EventController@store');
Route::get('event','EventController@calender');


Route::get('kintone','KintoneController@basic_request');
// 


// Route::get('/home','MainController@index');

