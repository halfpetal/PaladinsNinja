<?php

namespace PaladinsNinja\Http\Controllers\API\Player\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Player;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller
{
    public function show($player)
    {
        return Player::where('player_id', $player)->orWhere('name', $player)->firstOrFail();
    }

    public function friends($player)
    {
        return Player::where('player_id', $player)->orWhere('name', $player)->firstOrFail()->friends;
    }

    public function champions($player)
    {
        return Player::where('player_id', $player)->orWhere('name', $player)->firstOrFail()->champion_ranks;
    }


    public function status($player)
    {
        $model = Player::where('player_id', $player)->orWhere('name', $player)->firstOrFail();

        return Cache::remember('player.' . $model->player_id . '.status', 1, function() use($model) {
            return resolve('PaladinsAPI')->getPlayerStatus($model->player_id);
        });
    }

    public function live($player, $match)
    {
        $model = Player::where('player_id', $player)->orWhere('name', $player)->firstOrFail();

        return Cache::remember('player.' . $model->player_id . '.live', 3, function() use($model, $match) {
            return resolve('PaladinsAPI')->getActiveMatchDetails($match);
        });
    }
}
