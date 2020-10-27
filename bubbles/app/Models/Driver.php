<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Driver extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'username','password', 'phone','image','verified','driving_license',
        'email_verified','reset_password_code','code_expiration_date','id_number',
        'fcm_token','status', 'remember_token','registration_id'
    ];

    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration',
    ];

    public function packages () {
        return $this->hasMany(Package::class,'driver_id','id');
    }

    public function activePackage () {
        return $this->hasOne(Package::class,'driver_id','id')->where('status',['1','2']);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function randToken () {
        return rand(10000,99999);

    }
}
