<?php

namespace PaladinsNinja\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id', 'queue_id', 'match_date',
        'match_time_seconds', 'map_game', 'gamemode',
        'winning_task_force', 'task_force_1_score', 'task_force_2_score',
        'task_force_1', 'task_force_2', 'region'
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'task_force_1' => 'array',
        'task_force_2' => 'array',
    ];

    protected $hidden = [
        'id',
    ];

    public function getRouteKeyName()
    {
        return 'match_id';
    }
}
