<?php

namespace PaladinsNinja\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    use Filterable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'champion_id', 'health', 'speed',
        'onfreerotation', 'name', 'role',
        'title', 'icon_url', 'data', 'cards'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'cards' => 'array',
    ];
}
