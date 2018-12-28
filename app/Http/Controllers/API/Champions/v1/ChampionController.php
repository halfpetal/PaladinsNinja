<?php

namespace PaladinsNinja\Http\Controllers\API\Champions\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Champion;
use PaladinsNinja\Models\ChampionSkin;

class ChampionController extends Controller
{
    public function index(Request $request)
    {
        return Champion::filter($request->all())->paginate();
    }

    public function show(Champion $champion)
    {
        return $champion;
    }

    public function skinIndex(Champion $champion)
    {
        return $champion->skins()->paginate();
    }

    public function skinShow(Champion $champion, ChampionSkin $skin)
    {
        if ($champion->champion_id != $skin->champion_id) {
            return abort(404, 'No skin exists with that id that belongs to the requested champion.');
        }

        return $skin;
    }
}
