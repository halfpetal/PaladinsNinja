<?php

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('home');
});

Route::post('search', 'HomeController@search')->name('search');
Route::get('player/{player}/{any?}', 'HomeController@getPlayer')->name('player')->where('any', '.*');
Route::post('player/{player}/update', 'HomeController@updatePlayer')->name('player.update');
Route::delete('player/{player}', 'HomeController@deletePlayer')->name('player.delete');
Route::get('champion/{champion}', 'HomeController@getChampion')->name('champion');
Route::get('champions', 'HomeController@getAllChampions')->name('champions');
Route::get('match/{match}', 'HomeController@getMatch')->name('match');
Route::get('home', 'HomeController@index')->name('home');

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