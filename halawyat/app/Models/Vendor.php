<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Vendor extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function items () {
        return $this->hasMany(Item::class,'vendor_id','id');
    }

    public function orders () {
        return $this->hasMany(Order::class,'vendor_id','id');
    }

    public function userNotifications () {
        return $this->hasMany(Notification::class,'user_id','id');
    }

    public function category () {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function activeOrders () {
        return $this->hasMany(Order::class,'user_id','id')
            ->whereIn('status',array(['0','1','3']));
    }

    public function previousOrders () {
        return $this->hasMany(Order::class,'user_id','id')
            ->where('status','=','4');
    }


    protected $fillable = [
        'name', 'email', 'password', 'phone','image','category_id','rate',
        'verified','reset_password_code','code_expiration_date',
        'ads_count','fcm_token','status','lat','lng','delivery_time','delivery_cost',
    ];


    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function verifyMail ($name , $email,$code) {

        $data = array('name'=>$name, "body" => $code);

        Mail::send('templates.verificationMail', $data, function($message) use ($name, $email) {
            $message->to($email, $name)
                ->subject(' Verification Email ');
            $message->from('no_reply@DayForce.com','DayForce');
        });
        if (Mail::failures()){
            return false;
        }
        return true;
    }

    public static function randToken () {
        return rand(10000,99999);

    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

}
