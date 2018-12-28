<?php

namespace PaladinsNinja\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class ChampionSkin extends Model
{
    use Filterable;

    protected $fillable = [
        'champion_id', 'rarity', 'skin_id1',
        'skin_id2', 'skin_name', 'skin_name_english'
    ];
}
