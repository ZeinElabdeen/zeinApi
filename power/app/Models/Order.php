<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id','driver_id','start_lat','start_lng','end_lat','end_lng','distance','cost','req_expiration',
        'car_type','gender','coupon_code','coupon_value','status','code'];

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

    public function room () {
        return $this->hasOne(Room::class,'order_id','id');
    }

    public function attaches() {
        return $this->hasMany(Attach::class,'order_id','id');
    }
}
