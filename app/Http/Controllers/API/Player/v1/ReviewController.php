<?php

namespace PaladinsNinja\Http\Controllers\API\Player\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Requests\CreatePlayerReviewRequest;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Models\Player;
use PaladinsNinja\Http\Resources\PlayerReviewResource;
use PaladinsNinja\Models\Match;
use PaladinsNinja\Models\Rating;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'hirez_link'])->only('store');
    }

    public function index(Player $player)
    {
        return PlayerReviewResource::collection($player->ratings()->paginate());
    }

    public function store(CreatePlayerReviewRequest $request, Player $player)
    {
        if ($player->player_id === $request->user()->player->player_id) {
            return apiErrorResponse('You can not submit a review about yourself.');
        }

        $mostRecent = $player->ratings()->where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->first();

        if (isset($mostRecent)) {
            $canPostAfter = $mostRecent->created_at->addWeek();

            if (now()->between($mostRecent->created_at, $canPostAfter)) {
                return apiErrorResponse('You have to wait 7 days before posting another review.');
            }
        }

        if (!Match::where('match_id', $request->match_id)->exists()) {
            return apiErrorResponse('The requested match does not exist in our system.');
        }

        $match = Match::where('match_id', $request->match_id)->first();
        $team1 = $match->task_force_1;
        $team2 = $match->task_force_2;

        if ($match->gamemode != 'Ranked') {
            return apiErrorResponse('The match must be a ranked game for you to submit a review.');
        }

        if (!$this->isInTeam($team1, $player->player_id) && !$this->isInTeam($team2, $player->player_id)) {
            return apiErrorResponse('The player does not seem to be present in that match.');
        }

        if (!$this->isInTeam($team1, $request->user()->player->player_id) && !$this->isInTeam($team2, $request->user()->player->player_id)) {
            return apiErrorResponse('You do not seem to be present in that match.');
        }

        $matchAt = \Carbon\Carbon::parse($match->match_date);
        $matchMax = \Carbon\Carbon::parse($matchAt)->addDays(2);

        if (!now()->between($matchAt, $matchMax)) {
            return apiErrorResponse('That match is too old to make a review for. It has to be within 2 days of the match date.');
        }

        $rating = new Rating;
        $rating->match_id = $match->match_id;
        $rating->title = $request->title;
        $rating->body = $request->body;
        $rating->rating = $request->rating;
        $rating->user_id = \Auth::user()->id;

        $player->ratings()->save($rating);

        return response()->json([
            'message' => 'Your review is now published.'
        ]);
    }

    private function isInTeam($team, $id)
    {
        $result = array_first($team, function($value, $key) use ($id) {
            return $value['playerId'] == $id;
        }, null);

        return isset($result);
    }
}
