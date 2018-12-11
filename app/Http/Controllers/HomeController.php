<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;
use PaladinsNinja\Models\Player;
use PaladinsNinja\Jobs\ProcessPlayer;
use PaladinsNinja\Models\Champion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        if(Player::where('name', $request->get('name'))->exists()) {
            return redirect()->route('player', ['player' => $request->get('name')]);
        } else {
            ProcessPlayer::dispatch($request->get('name'))->onQueue('players');

            return view('errors.playernotfound');
        }
    }

    public function getPlayer($player)
    {
        if (Player::where('name', $player)->exists()) {
            $playerModel = Player::where('name', $player)->first();

            return view('player', ['player' => $playerModel]);
        } else if(Player::where('player_id', $player)->exists()) {
            $playerModel = Player::where('player_id', $player)->first();

            return view('player', ['player' => $playerModel]);
        } else {
            ProcessPlayer::dispatch($player)->onQueue('players');

            return view('errors.playernotfound');
        }
    }

    public function getChampion($champion)
    {
        if (Champion::where('champion_id', $champion)->exists()) {
            $championModel = Champion::where('champion_id', $champion)->first();
        } else if (Champion::where('name', $champion)->exists()) {
            $championModel = Champion::where('name', $champion)->first();
        } else {
            return abort(404);
        }

        return view('champion', ['champion' => $championModel]);
    }
}
