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
    protected $platform;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($playerName, string $platform = null)
    {
        if (is_numeric($playerName)) {
            $this->playerName = intval($playerName);
        } else {
            $this->playerName = $playerName;
        }
        
        switch(strtolower($platform)) {
            case 'nintendo':
                $this->platform = 22;
                break;
            case 'psn':
                $this->platform = 9;
                break;
            case 'xbl':
                $this->platform = 10;
                break;
            default:
                $this->platform = 5;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $playerData = resolve('PaladinsAPI')->getPlayer($this->playerName, $this->platform);

        if (empty($playerData)) {
            return;
        }

        $playerData = $playerData[0];
        $playerLoadouts = resolve('PaladinsAPI')->getPlayerLoadouts($playerData['Id']);
        $playerFriends = resolve('PaladinsAPI')->getPlayerFriends($playerData['Id']);
        $playerMatchHistory = resolve('PaladinsAPI')->getPlayerMatchHistory($playerData['Id']);
        $playerChampionRanks = resolve('PaladinsAPI')->getPlayerChampionRanks($playerData['Id']);
        $player = [];
        $matchHistory = [];

        foreach ($playerMatchHistory as $match)
        {   
            if ($match['Match']) {
                array_push($matchHistory, $match['Match']);

                if (!\PaladinsNinja\Models\Match::where('match_id', $match['Match'])->exists()) {
                    ProcessMatch::dispatch($match['Match'])->onQueue('match-history');
                }
            }
        }

        $player = array_add($player, 'loadouts', $playerLoadouts);
        $player = array_add($player, 'friends', $playerFriends);
        $player = array_add($player, 'match_history', $matchHistory);
        $player = array_add($player, 'ranked_conquest', $playerData['RankedConquest']);
        $player = array_add($player, 'champion_ranks', $playerChampionRanks);
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
        $player = array_add($player, 'ranked_kbm', $playerData['RankedKBM']);
        $player = array_add($player, 'ranked_controller', $playerData['RankedController']);
        $player = array_add($player, 'tier_ranked_kbm', $playerData['Tier_RankedKBM']);
        $player = array_add($player, 'tier_ranked_controller', $playerData['Tier_RankedController']);
        $player = array_add($player, 'data', $playerData);

        $playerModel = Player::updateOrCreate(['player_id' => $player['player_id']], $player);

        event(new \PaladinsNinja\Events\PlayerUpdated($playerModel->player_id));
    }
}
