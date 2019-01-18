<?php

namespace PaladinsNinja\Http\Controllers\Tools;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Loadout;

class LoadoutBuilderController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'hirez_link', 'permission:tools.loadout-builder.create'])->only('create');
        $this->middleware(['auth', 'hirez_link'])->only('create');
    }

    public function index(Request $request)
    {

        return view('tools.loadout-builder.index', [
            'loadouts' => Loadout::filter($request->all())->orderBy('created_at', 'desc')->paginate(),
            'pageTitle' => 'All Loadouts'
        ]);
    }

    public function create()
    {
        return view('tools.loadout-builder.create');
    }

    public function show(Loadout $loadout)
    {
        return view('tools.loadout-builder.show', [
            'loadout' => $loadout,
            'pageTitle' => 'View Loadout - ' . $loadout->name
        ]);
    }
}
