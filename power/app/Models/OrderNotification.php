<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderNotification extends Model
{
    protected $table = 'order_notifications';

    protected $fillable = ['user_id','driver_id','type','order_id','is_read','message_en','message_ar'];

    public static function send ($userId,$driverId,$type,$orderId,$messageAr,$messageEn) {
        $input = array();

        $input['user_id'] = $userId;
        $input['driver_id'] = $driverId;
        $input['type'] = $type;
        $input['order_id'] = $orderId;
        $input['message_ar'] = $messageAr;
        $input['message_en'] = $messageEn;

        $create = OrderNotification::create($input);

        return (!$create) ? false: true;
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }
}
