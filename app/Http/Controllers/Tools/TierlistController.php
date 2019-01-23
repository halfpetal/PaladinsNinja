<?php

namespace PaladinsNinja\Http\Controllers\Tools;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\ChampionTierlist;

class TierlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'hirez_link'])->only('create');
    }

    public function index()
    {
        return view('tools.tierlist.index', [
            'tierlists' => ChampionTierlist::orderBy('created_at', 'desc')->paginate(),
            'pageTitle' => 'All Tierlists'
        ]);
    }

    public function create()
    {
        return view('tools.tierlist.create');
    }

    public function show(ChampionTierlist $tierlist)
    {
        return view('tools.tierlist.show', [
            'tierlist' => $tierlist,
            'pageTitle' => 'View Tierlist - ' . $tierlist->name,
        ]);
    }
}
