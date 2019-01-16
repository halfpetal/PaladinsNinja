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

Route::get('settings/{any?}', 'UserController@getSettings')->name('settings')->where('any', '.*');

Route::post('theme/{theme}', function(\Illuminate\Http\Request $request, $theme) {
    $themes = ['cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'litera', 'lumen', 'lux', 'materia', 'minty', 'pulse', 'sandstone', 'simplex', 'sketchy', 'slate', 'solar', 'spacelab', 'superhero', 'united', 'yeti'];

    if (in_array($theme, $themes)) {
        $request->session()->put('user.theme', $theme);
        return redirect()->back();
    } else {
        return abort(404);
    }
})->name('theme.change');

Route::delete('theme', function(Request $request) {
    session()->forget('user.theme');

    return redirect()->back();
})->name('theme.remove');