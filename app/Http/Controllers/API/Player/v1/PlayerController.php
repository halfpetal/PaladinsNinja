<?php

namespace PaladinsNinja\Http\Controllers\API\Player\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Player;
use Illuminate\Support\Facades\Cache;
use PaladinsNinja\Jobs\ProcessMatch;
use PaladinsNinja\Models\MatchPlayer;

class PlayerController extends Controller
{
    public function show($player)
    {
        return Player::where('player_id', $player)->firstOrFail();
    }

    public function friends($player)
    {
        return Player::where('player_id', $player)->firstOrFail()->friends;
    }

    public function champions($player)
    {
        return Player::where('player_id', $player)->firstOrFail()->champion_ranks;
    }


    public function status($player)
    {
        $model = Player::where('player_id', $player)->firstOrFail();

        return Cache::remember('player.' . $model->player_id . '.status', 1, function() use($model) {
            return resolve('PaladinsAPI')->getPlayerStatus($model->player_id);
        });
    }

    public function live($player, $match)
    {
        $model = Player::where('player_id', $player)->firstOrFail();

        return Cache::remember('player.' . $model->player_id . '.live', 3, function() use($model, $match) {
            return resolve('PaladinsAPI')->getActiveMatchDetails($match);
        });
    }

    public function matches($player)
    {
        $model = Player::where('player_id', $player)->firstOrFail();
        $matches = [];

        foreach ($model->match_history as $match)
        {
            $match_player = MatchPlayer::where([
                'playerId' => $model->player_id,
                'Match' => $match
            ])->first();

            if (!isset($match_player)) {
                ProcessMatch::dispatch($match)->onQueue('match-history');

                continue;
            }

            array_push($matches, $match_player);
        }

        return $matches;
    }
}
