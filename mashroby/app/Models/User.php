<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function ads () {
        return $this->hasMany(Ad::class,'user_id','id');
    }

    public function userNotifications () {
        return $this->hasMany(Notification::class,'user_id','id');
    }

    public function favoriteOrders () {
        return $this->hasMany(Favorite::class,'user_id','id')
            ->where('order_id','!=',null);
    }

    public function favoriteItems () {
        return $this->hasMany(Favorite::class,'user_id','id')
            ->where('ad_id','!=',null);
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
        'username', 'type','email', 'password', 'phone','image',
        'is_verified','reset_password_code','code_expiration_date',
        'membership_image','ads_count','fcm_token','language','status',
        'remember_token','plan_id'
    ];


    protected $hidden = [
        'password', 'remember_token','updated_at','reset_password_code',
        'code_expiration','membership_image','membership_ads_count',
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
