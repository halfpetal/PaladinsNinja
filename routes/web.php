<?php
// Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('home');
});

Route::post('search', 'HomeController@search')->name('search');
Route::get('player/{player}', 'HomeController@getPlayer')->name('player');
Route::get('champion/{champion}', 'HomeController@getChampion')->name('champion');
Route::get('champions', 'HomeController@getAllChampions')->name('champions');
Route::get('home', 'HomeController@index')->name('home');