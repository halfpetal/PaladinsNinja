<?php

use Illuminate\Http\Request;
use PaladinsNinja\Models\Player;
use PaladinsNinja\Models\Match;
use PaladinsNinja\Models\Champion;

Route::get('champion/{champion}', function(Reqest $request, $champion) {
    return Champion::firstOrFail(['champion_id' => $champion]);
});

Route::geT('player/{player}/champions', function(Request $request, $player) {
    $playerModel;

    if (Player::where('name', $player)->exists()) {
        $playerModel = Player::where('name', $player)->first();
    } else if(Player::where('player_id', $player)->exists()) {
        $playerModel = Player::where('player_id', $player)->first();
    } else {
        return abort(404);
    }

    return [
        'championRanks' => $playerModel->champion_ranks,
        'champions' => Champion::all()
    ];
});

Route::get('player/{player}/matches', function(Request $request, $player) {
    $playerModel;

    if (Player::where('name', $player)->exists()) {
        $playerModel = Player::where('name', $player)->first();
    } else if(Player::where('player_id', $player)->exists()) {
        $playerModel = Player::where('player_id', $player)->first();
    } else {
        return abort(404);
    }

    $matches = [];

    foreach(json_decode($playerModel->match_history) as $match) {
        if (Match::where('match_id', $match)->exists()) {
            array_push($matches, Match::where('match_id', $match)->first());
        } else {
            \PaladinsNinja\Jobs\ProcessMatch::dispatch($match)->onQueue('matches');
        }
    } 

    return [
        'matches' => $matches,
        'champions' => Champion::all(),
    ];
});