<?php

namespace PaladinsNinja\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use PaladinsNinja\Models\Match;
use PaladinsNinja\Models\MatchPlayer;
use PaladinsNinja\Models\Champion;

class ProcessMatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $matchId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $matchId)
    {
        $this->matchId = $matchId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $matchData = resolve('PaladinsAPI')->getMatchDetails($this->matchId);
        $taskForce1 = [];
        $taskForce2 = [];
        $gameInfo = [];

        foreach ($matchData as $player) {
            if ($player['TaskForce'] == 1) {
                array_push($taskForce1, $player);
            } else {
                array_push($taskForce2, $player);
            }

            $player = array_add($player, 'champion_role', Champion::where('name', $player['Reference_Name'])->first()->role);

            MatchPlayer::create($player);
        }

        $gameInfo = array_add($gameInfo, 'match_id', $matchData[0]['Match']);
        $gameInfo = array_add($gameInfo, 'queue_id', $matchData[0]['match_queue_id']);
        $gameInfo = array_add($gameInfo, 'match_date', \Carbon\Carbon::parse($matchData[0]['Entry_Datetime']));
        $gameInfo = array_add($gameInfo, 'region', $matchData[0]['Region']);
        $gameInfo = array_add($gameInfo, 'match_time_seconds', $matchData[0]['Time_In_Match_Seconds']);
        $gameInfo = array_add($gameInfo, 'map_game', $matchData[0]['Map_Game']);
        $gameInfo = array_add($gameInfo, 'gamemode', $matchData[0]['name']);
        $gameInfo = array_add($gameInfo, 'winning_task_force', $matchData[0]['Winning_TaskForce']);
        $gameInfo = array_add($gameInfo, 'task_force_1_score', $matchData[0]['Team1Score']);
        $gameInfo = array_add($gameInfo, 'task_force_2_score', $matchData[0]['Team2Score']);
        $gameInfo = array_add($gameInfo, 'task_force_1', json_encode($taskForce1));
        $gameInfo = array_add($gameInfo, 'task_force_2', json_encode($taskForce2));

        $match = Match::updateOrCreate(['match_id' => $gameInfo['match_id']], $gameInfo);
    }
}
