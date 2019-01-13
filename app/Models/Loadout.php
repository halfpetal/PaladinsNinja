<?php

namespace PaladinsNinja\Models;

use Halfpetal\Laravel\Identifiable\Traits\Identifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loadout extends Model
{
    use SoftDeletes, Identifiable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cards' => 'array',
    ];

    protected $hidden = [
        'id'
    ];
}
