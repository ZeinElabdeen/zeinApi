<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['user_id','driver_id','order_id','is_closed'];

    public function messages () {
        return $this->hasMany(Message::class,'room_id','id')->orderBy('id','desc');
    }

    public function lastMessage () {
        return $this->hasOne(Message::class,'room_id','id')->latest();
    }

    public function sender () {
        return $this->belongsTo(User::class,'sender_id','id');
    }

    public function receiver () {
        return $this->belongsTo(User::class,'receiver_id','id');
    }

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
