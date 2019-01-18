<?php

namespace PaladinsNinja\Models;

use Halfpetal\Laravel\Identifiable\Traits\Identifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PaladinsNinja\Traits\Rateable;
use EloquentFilter\Filterable;

class Loadout extends Model
{
    use SoftDeletes, Identifiable, Rateable, Filterable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cards' => 'array',
    ];

    protected $fillable = [
        'user_id', 'champion_id', 'name',
        'description', 'cards'
    ];

    protected $hidden = [
        'id'
    ];

    public function champion()
    {
        return $this->belongsTo(Champion::class, 'champion_id', 'champion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
