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
        'username','password', 'phone','rate','image','verified',
        'reset_password_code','code_expiration_date',
        'fcm_token','status', 'remember_token','birth_date'
    ];

    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration','email'
    ];

    public function userRated () {
        return $this->hasMany(UserRate::class,'user_id','id');
    }

    public function peopleTransfers () {
        return $this->hasMany(Order::class,'user_id','id')
            ->where('type','=','0');
    }

    public function packagesTransfers () {
        return $this->hasMany(Order::class,'user_id','id')
            ->where('type','=','1');
    }

    public function notifications () {
      //  return $this->hasMany(GeneralNotification::class,'user_id','id');
        return $this->hasMany(OrderNotification::class,'user_id','id')->where('type','0');
    }

    public function rates () {
        return $this->hasMany(Rate::class,'user_id','id');
    }

    public function places () {
        return $this->hasMany(UserPlaces::class,'user_id','id');
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
