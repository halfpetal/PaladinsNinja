<?php

namespace PaladinsNinja\Models;

use Halfpetal\Laravel\Identifiable\Traits\Identifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PaladinsNinja\Traits\Rateable;
use EloquentFilter\Filterable;

class ChampionTierlist extends Model
{
    use SoftDeletes, Identifiable, Rateable, Filterable;

    protected $fillable = [
        'name', 'description', 'tier_ss',
        'tier_s', 'tier_a', 'tier_b', 
        'tier_c', 'tier_d', 'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tier_ss' => 'array',
        'tier_s' => 'array',
        'tier_a' => 'array',
        'tier_b' => 'array',
        'tier_c' => 'array',
        'tier_d' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
