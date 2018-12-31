<?php

namespace PaladinsNinja\Http\Controllers\API\Match\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Match;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        return Match::filter($request->all())->paginate();
    }

    public function show(Match $match)
    {
        return $match;
    }
}
