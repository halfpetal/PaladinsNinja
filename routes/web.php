<?php

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('terms-of-service', function() {
    return view('terms');
})->name('tos');

Route::get('privacy-policy', function() {
    return view('privacy');
})->name('privacy-policy');

Route::get('paladins-news/{any?}', function() {
    return view('paladins-news');
})->name('paladins-news')->where('any', '.*');

Route::get('/@{user}', 'UserController@show')->name('user.show');

Route::get('loadouts', 'Tools\LoadoutBuilderController@index')->name('tools.loadout-builder.index');
Route::get('loadouts/{loadout}', 'Tools\LoadoutBuilderController@show')->name('tools.loadout-builder.show');

Route::get('tierlists', 'Tools\TierlistController@index')->name('tools.tierlist.index');
Route::get('tierlist/{tierlist}', 'Tools\TierlistController@show')->name('tools.tierlist.show');

Route::post('search', 'PlayerController@search')->name('search');
Route::get('hirez-link', 'UserController@getHirezLink')->name('hirez-link.show');

Route::get('player/{player}/{any?}', 'HomeController@getPlayer')->name('player')->where('any', '.*');
Route::post('player/{player}/update', 'HomeController@updatePlayer')->name('player.update');
Route::delete('player/{player}', 'HomeController@deletePlayer')->name('player.delete');

Route::get('champion/{champion}', 'ChampionController@show')->name('champion.show');
Route::get('champions', 'ChampionController@index')->name('champion.index');

Route::get('match/{match}', 'HomeController@getMatch')->name('match');

Route::get('home', 'HomeController@index')->name('home');

Route::get('tools/loadout-builder/create', 'Tools\LoadoutBuilderController@create')->name('tools.loadout-builder.create');
Route::get('tools/tierlist/create', 'Tools\TierlistController@create')->name('tools.tierlist.create');


Route::get('settings/{any?}', 'UserController@getSettings')->name('settings')->where('any', '.*');

Route::post('theme/{theme}', 'ThemeController@set')->name('theme.change');
Route::delete('theme', 'ThemeController@remove')->name('theme.remove');