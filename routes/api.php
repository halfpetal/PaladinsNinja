<?php

use Illuminate\Http\Request;
use PaladinsNinja\Models\Player;
use PaladinsNinja\Models\Match;
use PaladinsNinja\Models\Champion;
use Illuminate\Support\Facades\Cache;
use PaladinsNinja\Jobs\ProcessMatch;

Route::get('champion/{champion}', function(Reqest $request, $champion) {
    return Champion::firstOrFail(['champion_id' => $champion]);
});

Route::get('player/{player}/details', function(Request $request, $player) {
    $player = Player::where('player_id', $player)->firstOrFail();

    return response()->json([
        'player' => $player,
        'playerDetailDisplay' => [
            'registered_at' => [
                'exact' => \Carbon\Carbon::parse($player->registered_at)->toDayDateTimeString() . ' UTC',
                'relative' => \Carbon\Carbon::parse($player->registered_at)->diffForHumans(),
            ],
            'last_login_at' => [
                'exact' => \Carbon\Carbon::parse($player->last_login_at)->toDayDateTimeString() . ' UTC',
                'relative' => \Carbon\Carbon::parse($player->last_login_at)->diffForHumans(),
            ]
        ],
        'champions' => Champion::get()
    ]);
});

Route::get('player/{player}/champions', function(Request $request, $player) {
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

Route::get('player/{player}/status', function(Request $request, $player) {
    return Cache::remember('player' . $player . 'status', 1, function() use ($player) {
        return resolve('PaladinsAPI')->getPlayerStatus($player);
    });
});

Route::get('player/{player}/{match}/live', function(Request $request, $player, $match) {
    return Cache::remember('player' . $player . 'live', 5, function() use ($player, $match) {
        return resolve('PaladinsAPI')->getActiveMatchDetails($match);
    });
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

    foreach($playerModel->match_history as $match) {
        if (Match::where('match_id', $match)->exists()) {
            array_push($matches, Match::where('match_id', $match)->first());
        } else {
            \Log::info('Processing match for match history: ' . $match);
            ProcessMatch::dispatch($match)->onQueue('match-history');
        }
    } 

    return [
        'matches' => $matches,
        'champions' => Champion::all(),
    ];
});