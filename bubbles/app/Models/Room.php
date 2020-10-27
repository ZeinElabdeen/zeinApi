<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['user_id','vendor_id'];

    public function messages () {
        return $this->hasMany(Message::class,'room_id','id');
    }
}
