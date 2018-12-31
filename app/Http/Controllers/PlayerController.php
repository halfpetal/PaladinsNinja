<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Requests\SearchPlayer;
use PaladinsNinja\Models\Player;

class PlayerController extends Controller
{
    public function search(SearchPlayer $request)
    {
        $players = \Cache::remember("search.name.{$request->name}", now()->addHours(6), function() use ($request) {
            return resolve('PaladinsAPI')->getPlayerIdByName($request->name);
        });

        return view('search-results', [
            'players' => $players,
            'query' => $request->name,
            'pageTitle' => 'Search Results'
        ]);
    }
}
