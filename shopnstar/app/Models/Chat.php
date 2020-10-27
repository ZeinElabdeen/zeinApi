<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $fillable = ['order_id','user_id','vendor_id','statue'];


    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function vendor () {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}
