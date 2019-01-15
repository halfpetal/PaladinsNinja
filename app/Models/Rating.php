<?php

namespace PaladinsNinja\Models;

use Config;
use Halfpetal\Laravel\Identifiable\Traits\Identifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes, Identifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'rating', 'title', 'body',
        'match_id'
    ];
    /**
     * @return mixed
     */
    public function rateable()
    {
        return $this->morphTo();
    }
    /**
     * Rating belongs to a user.
     *
     * @return User
     */
    public function user()
    {
        $userClassName = Config::get('auth.model');
        if (is_null($userClassName)) {
            $userClassName = Config::get('auth.providers.users.model');
        }
        return $this->belongsTo($userClassName);
    }
}