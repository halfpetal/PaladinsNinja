<?php

namespace PaladinsNinja\Models;

use Illuminate\Database\Eloquent\Model;

class InGameItem extends Model
{
    protected $fillable = [
        'Description', 'DeviceName', 'IconId',
        'ItemId', 'Price', 'ShortDesc', 
        'itemIcon_URL', 'item_type', 'recharge_seconds',
        'talent_reward_level'
    ];
}
