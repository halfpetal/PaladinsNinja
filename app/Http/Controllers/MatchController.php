<?php

namespace PaladinsNinja\Http\Controllers;

use Illuminate\Http\Request;
use PaladinsNinja\Models\Match;

class MatchController extends Controller
{
    public function show(Request $request, Match $match)
    {
        return view('match', ['match' => $match, 'tableView' => $request->get('tableView')]);
    }
}
