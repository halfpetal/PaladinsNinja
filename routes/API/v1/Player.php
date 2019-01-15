<?php

Route::get('{player}', 'PlayerController@show')->name('show');
Route::get('{player}/champions', 'PlayerController@champions')->name('champions');
Route::get('{player}/friends', 'PlayerController@friends')->name('friends');
Route::get('{player}/status', 'PlayerController@status')->name('status');
Route::get('{player}/live/{match}', 'PlayerController@live')->name('live');
Route::get('{player}/matches', 'PlayerController@matches')->name('matches');
Route::get('{player}/loadouts', 'PlayerController@loadouts')->name('loadouts');
Route::post('{player}/update', 'PlayerController@update')->name('update');

Route::get('{player}/review', 'ReviewController@index')->name('review.index');
Route::post('{player}/review', 'ReviewController@store')->name('review.store');