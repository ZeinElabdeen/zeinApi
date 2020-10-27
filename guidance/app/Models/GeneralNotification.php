<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralNotification extends Model
{
    protected $table = 'general_notifications';

    protected $fillable = ['user_id','driver_id','is_read','message_en','message_ar'];

    public static function send ($userId,$driverId,$messageAr,$messageEn) {
        $input = array();

        $input['user_id'] = $userId;
        $input['driver_id'] = $driverId;
        $input['message_ar'] = $messageAr;
        $input['message_en'] = $messageEn;

        $create = GeneralNotification::create($input);

        return (!$create) ? false: true;
    }

    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function driver () {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }
}
