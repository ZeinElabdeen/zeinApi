<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['sender_id','receiver_id'];

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
}
