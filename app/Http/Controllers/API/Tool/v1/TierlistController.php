<?php

namespace PaladinsNinja\Http\Controllers\API\Tool\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Http\Requests\StoreTierlistRequest;
use PaladinsNinja\Models\ChampionTierlist;

class TierlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'hirez_link'])->only('store');
    }

    public function store(StoreTierlistRequest $request)
    {
        if ($request->has('champions') && count($request->champions) > 0) {
            return apiErrorResponse('All champions must be placed within a tier.');
        }

        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;

        $tierlist = ChampionTierlist::create($data);

        return response()->json([
            'id' => $tierlist->indentifier->identifier,
        ]);
    }
}
