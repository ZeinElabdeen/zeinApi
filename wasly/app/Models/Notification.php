<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['order_id','body','type','user_id'];

    public static function send ($orderId,$type,$body,$userId) {
        $create = Notification::create([
            'order_id' => $orderId,
            'body' => $body,
            'type' => $type,
            'user_id' => $userId,
        ]);
    }


}
