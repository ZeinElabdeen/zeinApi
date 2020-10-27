<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat_mess extends Model
{
    protected $table = 'chat_mess';

    protected $fillable = ['chat_id','sender_type','seen','mesg','type'];

    public function chat () {
        return $this->belongsTo(Chat::class,'chat_id','id');
    }

}
