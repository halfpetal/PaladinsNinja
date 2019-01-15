<?php

namespace PaladinsNinja\Http\Controllers\Tools;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;

class LoadoutBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'hirez_link', 'verified', 'permission:tools.loadout.builder.create'])->only('create');
    }

    public function create()
    {
        return view('tools.loadout-builder.create');
    }
}
