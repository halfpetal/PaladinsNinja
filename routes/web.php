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
// Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('home');
});

Route::post('search', 'HomeController@search')->name('search');
Route::get('player/{player}', 'HomeController@getPlayer')->name('player');
Route::get('/home', 'HomeController@index')->name('home');



