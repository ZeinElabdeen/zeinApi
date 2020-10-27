<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCancelReason extends Model
{
    protected $table = 'order_cancel_reason';

    protected $fillable = ['reason_id','order_id'];
}
