<?php

namespace PaladinsNinja\Http\Controllers\API\Tool\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Champion;
use PaladinsNinja\Http\Requests\StoreLoadoutRequest;
use PaladinsNinja\Models\Loadout;

class LoadoutBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'hirez_link', 'permission:tools.loadout-builder.create'])->only('store');
        // $this->middleware(['auth:api', 'hirez_link', 'permission:tools.loadout-builder.create'])->only('store');
    }

    public function store(StoreLoadoutRequest $request)
    {
        $cards = $request->cards;
        $champion = Champion::where('champion_id', $request->champion)->firstOrFail();
        $totalPoints = 0;

        foreach($cards as $card) {
            if ($card['id'] <= 0) {
                return apiErrorResponse('Every card must be present (5 total cards).');
            }
            
            if ($card['points'] < 1 || $card['points'] > 5) {
                return apiErrorResponse('Invalid point count.');
            }

            $totalPoints += $card['points'];

            if ($totalPoints > 15) {
                return apiErrorResponse('Total points must not exceed 15.');
            }

            $firstCard = array_first($champion->cards, function($value, $key) use ($card) {
                return $value['card_id1'] == $card['id'] || $value['card_id2'] == $card['id'];
            }, null);

            if (!isset($firstCard)) {
                return apiErrorResponse('Invalid card id for the champion. Card #' . $card['id']);
            }
        }

        if ($totalPoints < 15) {
            return apiErrorResponse('Total points must be equal to 15.');
        }

        $loadout = Loadout::create([
            'user_id' => \Auth::user()->id,
            'champion_id' => $champion->champion_id,
            'name' => $request->name,
            'cards' => $request->cards,
            'description' => $request->has('description') ? $request->description : null,
        ]);

        return response()->json([
            'id' => $loadout->identifier->identifier,
        ]);
    }
}
