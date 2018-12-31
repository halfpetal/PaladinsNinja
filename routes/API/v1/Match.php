<?php

Route::get('list', 'MatchController@index')->name('index');
Route::get('{match}', 'MatchController@show')->name('show');