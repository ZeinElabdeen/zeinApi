<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'room_messages';

    protected $fillable = ['room_id','sender_id','content','content_type','read','type'];
}
