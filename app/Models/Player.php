<?php

namespace PaladinsNinja\Models;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use Rateable;
    
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
        'loadouts', 'champion_ranks', 'data'
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
        'data' => 'array',
    ];

    protected $hidden = [
        'id'
    ];

    protected $appends = [
        'registered_at_relative',
        'last_login_at_relative',
        'average_community_rating',
    ];

    public function matches()
    {
        return $this->hasMany(MatchPlayer::class, 'playerId', 'player_id');
    }

    public function getRegisteredAtRelativeAttribute()
    {
        return \Carbon\Carbon::parse($this->registered_at)->diffForHumans();
    }

    public function getLastLoginAtRelativeAttribute()
    {
        return \Carbon\Carbon::parse($this->last_login_at)->diffForHumans();
    }

    public function getAverageCommunityRatingAttribute()
    {
        return $this->averageRating();
    }
}
