<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    protected $table = 'user_rates';

    protected $fillable = ['user_id','order_id','driver_id','rate','review'];

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }
}
