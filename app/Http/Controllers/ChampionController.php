<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;
use PaladinsNinja\Models\Champion;

class ChampionController extends Controller
{
    public function index(Request $request)
    {
        return view('champions', [
            'champions' => Champion::filter($request->all())->get(),
            'pageTitle' => 'Champion List'
        ]);
    }

    public function show(Request $request, $champion)
    {
        if (Champion::where('champion_id', $champion)->exists()) {
            $champion = Champion::where('champion_id', $champion)->firstOrFail();
        } else if (Champion::where('name', $champion)->exists()) {
            $champion = Champion::where('name', $champion)->firstOrFail();
        } else {
            return abort(404);
        }

        return view('champion', [
            'champion' => $champion,
            'pageTitle' => $champion->name
        ]);
    }
}
