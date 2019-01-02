<?php

Route::get('list', 'ChampionController@index')->name('index');
Route::get('{champion}', 'ChampionController@show')->name('show');
Route::get('{champion}/skins', 'ChampionController@skinIndex')->name('skin.index');
Route::get('{champion}/skins/{skin}', 'ChampionController@skinShow')->name('skin.show');