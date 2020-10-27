<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverRequest extends Model
{
    protected $table = 'deliver_requests';

    protected $fillable = ['driver_id','order_id','distanc_to_start'];

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

    public function order () {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
