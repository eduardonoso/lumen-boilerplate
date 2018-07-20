<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //    protected $fillable = [
    //        'name', 'email',
    //    ];

    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'api_token',
        'email_verified'
    ];

    CONST STATUS_PENDING = 0;
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_DENIED = 2;

    CONST STATUSES = [0 => 'pending', 1 => 'active', 2 => 'denied'];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function getStatusAttribute($status)
    {
        return User::STATUSES[$status];
    }
}
