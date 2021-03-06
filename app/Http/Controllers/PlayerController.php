<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Requests\SearchPlayer;
use PaladinsNinja\Models\Player;

class PlayerController extends Controller
{
    public function search(SearchPlayer $request)
    {
        $players = \Cache::remember("search.name.{$request->name}", 1, function() use ($request) {
            $players = resolve('PaladinsAPI')->getPlayerIdByName($request->name);
            $playersPS4 = resolve('PaladinsAPI')->getPlayerIdsByGamertag($request->name, 9);
            $playersXbox = resolve('PaladinsAPI')->getPlayerIdsByGamertag($request->name, 10);
            $playersSwitch = resolve('PaladinsAPI')->getPlayerIdsByGamertag($request->name, 22);

            if (!empty($playersPS4)) {
                foreach($playersPS4 as $pps) {
                    array_push($players, $pps);
                }
            }
            
            if (!empty($playersXbox)) {
                foreach($playersXbox as $px) {
                    array_push($players, $px);
                }
            }

            if (!empty($playersSwitch)) {
                foreach($playersSwitch as $ps) {
                    array_push($players, $ps);
                }
            }

            return $players;
        });

        return view('search-results', [
            'players' => $players,
            'query' => $request->name,
            'pageTitle' => 'Search Results'
        ]);
    }
}
