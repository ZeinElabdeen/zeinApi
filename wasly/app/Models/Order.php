<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id','village_id','code','shipping_cost','status','coupon','coupon_discount','address_description',
        'order_cost','total_cost',
    ];

    public function orderItems () {
        return $this->hasMany(OrderItems::class,'order_id','id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function village () {
        return $this->belongsTo(City::class,'village_id','id');
    }



}
