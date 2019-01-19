<?php

namespace PaladinsNinja\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['linked_hirez_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 
        'linked_hirez_at', 'paladins_player_id', 'hirez_account_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function player()
    {
        return $this->hasOne(Player::class, 'player_id', 'paladins_player_id');
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function loadouts()
    {
        return $this->hasMany(Loadout::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}