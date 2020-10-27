<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function city () {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function userNotifications () {
        return $this->hasMany(Notification::class,'user_id','id');
    }

    public function orders () {
        return $this->hasMany(Order::class,'user_id','id')->orderBy('id', 'desc');
    }


    protected $fillable = [
        'first_name','last_name', 'password', 'phone','image',
        'is_verified','reset_password_code','code_expiration_date',
        'fcm_token','language','status','city_id',
        'remember_token',
    ];


    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration'
    ];

    public static function randToken () {
        return rand(10000,99999);

    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

}
