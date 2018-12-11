<?php

namespace PaladinsNinja\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id', 'registered_at', 'last_login_at',
        'hours_played', 'leaves', 'level', 
        'losses', 'mastery_level', 'name',
        'platform', 'region', 'tier_conquest',
        'total_achievements', 'total_xp', 'wins',
        'ranked_conquest', 'match_history', 'friends',
        'loadouts', 'champion_ranks'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ranked_conquest' => 'array',
        'match_history' => 'array',
        'friends' => 'array',
        'loadouts' => 'array',
        'champion_ranks' => 'array',
    ];

    public function matches()
    {
        return $this->hasMany(MatchPlayer::class, 'playerId', 'player_id');
    }
}
