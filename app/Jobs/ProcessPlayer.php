<?php

namespace PaladinsNinja\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use PaladinsNinja\Models\Player;

class ProcessPlayer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $playerName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $playerName)
    {
        $this->playerName = $playerName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $playerData = resolve('PaladinsAPI')->getPlayer($this->playerName);

        if (empty($playerData)) {
            return;
        }

        $playerData = $playerData[0];
        $playerLoadouts = resolve('PaladinsAPI')->getPlayerLoadouts($playerData['Id']);
        $playerFriends = resolve('PaladinsAPI')->getPlayerFriends($playerData['Id']);
        $playerMatchHistory = resolve('PaladinsAPI')->getMatchHistory($this->playerName);
        $playerChampionRanks = resolve('PaladinsAPI')->getChampionRanks($playerData['Id']);
        $player = [];
        $matchHistory = [];

        foreach ($playerMatchHistory as $match)
        {
            array_push($matchHistory, $match['Match']);
        }

        $player = array_add($player, 'loadouts', json_encode($playerLoadouts));
        $player = array_add($player, 'friends', json_encode($playerFriends));
        $player = array_add($player, 'match_history', json_encode($matchHistory));
        $player = array_add($player, 'ranked_conquest', json_encode($playerData['RankedConquest']));
        $player = array_add($player, 'champion_ranks', json_encode($playerChampionRanks));
        $player = array_add($player, 'player_id', $playerData['Id']);
        $player = array_add($player, 'registered_at',  \Carbon\Carbon::parse($playerData['Created_Datetime']));
        $player = array_add($player, 'last_login_at',  \Carbon\Carbon::parse($playerData['Last_Login_Datetime']));
        $player = array_add($player, 'hours_played', $playerData['HoursPlayed']);
        $player = array_add($player, 'leaves', $playerData['Leaves']);
        $player = array_add($player, 'level', $playerData['Level']);
        $player = array_add($player, 'losses', $playerData['Losses']);
        $player = array_add($player, 'mastery_level', $playerData['MasteryLevel']);
        $player = array_add($player, 'name', $playerData['Name']);
        $player = array_add($player, 'platform', $playerData['Platform']);
        $player = array_add($player, 'region', $playerData['Region']);
        $player = array_add($player, 'tier_conquest', $playerData['Tier_Conquest']);
        $player = array_add($player, 'total_achievements', $playerData['Total_Achievements']);
        $player = array_add($player, 'total_xp', $playerData['Total_Worshippers']);
        $player = array_add($player, 'wins', $playerData['Wins']);

        $playerModel = Player::updateOrCreate(['player_id' => $player['player_id']], $player);
    }
}
