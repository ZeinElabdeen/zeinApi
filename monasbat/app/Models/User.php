<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';

    protected $fillable = [
        'type', 'username', 'phone','password','lng','lat','image',
        'reset_password_code','code_expiration','address','city_id',
        'category_id','fcm_token','status','verified','remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function vendorDetails () {
        return $this->hasOne(VendorDetails::class,'vendor_id','id');
    }

    public function senderRooms () {
        return $this->hasMany(Room::class,'sender_id','id');
    }

    public function receiverRooms () {
        return $this->hasMany(Room::class,'receiver_id','id');
    }

    public function favorites () {
        return $this->hasMany(Favorite::class,'user_id','id');
    }

    public function attaches () {
        return $this->hasMany(Attach::class,'vendor_id','id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
