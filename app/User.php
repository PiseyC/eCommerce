<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Model;
use Cache;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Check enable user
     * 
     */
    public function findForPassport($identifier) {
        return User::orWhere('email', $identifier)->where('status', 1)->first();
    }

    /**
     * Check online user
     * 
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

}