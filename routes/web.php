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

Route::get('/', function () {
    return view('home');
});

Route::post('search', 'HomeController@search')->name('search');

Route::get('player/{player}', 'HomeController@getPlayer')->name('player');

Route::get('/t', function() {
    // return resolve('PaladinsAPI')->getDataUsage();
    return resolve('PaladinsAPI')->getMatchIdsByQueue('0', \Carbon\Carbon::now()->format('Y-m-d'), 445);
    // $team1 = [];
    // $team2 = [];
    // $players = resolve('PaladinsAPI')->getMatchDetails(614224093);

    // foreach ($players as $player) {
    //     if ($player['TaskForce'] == 1) {
    //         array_push($team1, $player);
    //     } else {
    //         array_push($team2, $player);
    //     }
    // }

    // return ['team1' => $team1, 'team2' => $team2];
});

Route::get('/q', function() {
    \PaladinsNinja\Jobs\ProcessPlayer::dispatch('Zencep');
    
    return 'dispatched';
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
