<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Driver extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'username','password', 'phone','email','image','verified','wallet',
        'reset_password_code','code_expiration_date','gender','service','car_model_id','car_type_id',
        'id_number','car_color','id_image','car_front_image','car_back_image','car_form_image','driving_license_image',
        'fcm_token','status', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration',
    ];

    public function driverRated () {
        return $this->hasMany(DriverRate::class,'driver_id','id');
    }

    public function doneOrders () {
        return $this->hasMany(Order::class,'driver_id','id')
            ->where('status','=','3');
    }

    public function activeOrder () {
        return $this->hasMany(Order::class,'driver_id','id')
            ->whereIn('status',array('1','2'));
    }

    public function notifications_driver() {
        return $this->hasMany(OrderNotification::class,'driver_id','id')->where('type','1');
    }

    public function car_type () {
        return $this->belongsTo(CarType::class,'car_type_id','id');
    }

    public function car_model () {
        return $this->belongsTo(CarModel::class,'car_model_id','id');
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
