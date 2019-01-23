<?php

namespace PaladinsNinja\Http\Controllers\Tools;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;

class TierlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'hirez_link'])->only('create');
    }

    public function create()
    {
        return view('tools.tierlist.create');
    }
}
