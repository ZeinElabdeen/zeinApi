<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password', 'phone','image','verified',
        'email_verified','reset_password_code','code_expiration_date',
        'fcm_token','status', 'remember_token','registration_id'
    ];

    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration',
    ];

    public function packages () {
        return $this->hasMany(Package::class,'user_id','id');
    }

    public function notifications () {
        return $this->hasMany(Notification::class,'user_id','id');
    }

    public function rates () {
        return $this->hasMany(Rate::class,'user_id','id');
    }

    public function specificDriverRate ($id) {
        $rate = $this->rates()->where('driver_id',$id)->first();
        return $rate->rate;
    }

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
