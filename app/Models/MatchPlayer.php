<?php

namespace PaladinsNinja\Models;

use Illuminate\Database\Eloquent\Model;

class MatchPlayer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ActiveId1', 'ActiveId2', 'ActiveId3', 
        'ActiveId4', 'ActiveLevel1', 'ActiveLevel2', 
        'ActiveLevel3', 'ActiveLevel4', 'Assists', 
        'BanId1', 'BanId2', 'BanId3', 
        'BanId4', 'Camps_Cleared', 'ChampionId', 
        'Damage_Bot', 'Damage_Done_In_Hand', 'Damage_Done_Magical', 
        'Damage_Done_Physical', 'Damage_Mitigated', 'Damage_Player', 
        'Damage_Taken', 'Damage_Taken_Magical', 'Damage_Taken_Physical', 
        'Deaths', 'Distance_Traveled', 'Final_Match_Level', 
        'Gold_Earned', 'Gold_Per_Minute', 'Healing', 
        'Healing_Bot', 'Healing_Player_Self', 'ItemId1', 
        'ItemId2', 'ItemId3', 'ItemId4', 
        'ItemId5', 'ItemId6', 'ItemLevel1', 
        'ItemLevel2', 'ItemLevel3', 'ItemLevel4', 
        'ItemLevel5', 'ItemLevel6', 'Killing_Spree', 
        'Kills_Bot', 'Kills_Double', 'Kills_Fire_Giant', 
        'Kills_First_Blood', 'Kills_Gold_Fury', 'Kills_Penta', 
        'Kills_Phoenix', 'Kills_Player', 'Kills_Quadra', 
        'Kills_Siege_Juggernaut', 'Kills_Single', 'Kills_Triple', 
        'Kills_Wild_Juggernaut', 'League_Losses', 'League_Points', 
        'League_Tier', 'League_Wins', 'Match', 
        'Multi_kill_Max', 'Objective_Assists', 'PartyId', 
        'Rank_Stat_League', 'SkinId', 'Structure_Damage', 
        'Surrendered', 'TaskForce', 'Team1Score', 
        'Team2Score', 'TeamId', 'Time_In_Match_Seconds', 
        'Towers_Destroyed', 'Wards_Placed', 'Winning_TaskForce', 
        'playerId', 'match_queue_id','Entry_Datetime', 
        'Map_Game', 'Platform', 'Reference_Name', 
        'Region', 'Skin', 'Win_Status'
    ];
}
