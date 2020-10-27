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
        return $this->hasMany(Item::class,'user_id','id');
    }

    public function userNotifications () {
        return $this->hasMany(Notification::class,'user_id','id');
    }

    public function favorites () {
        return $this->hasMany(Favorite::class,'user_id','id');
    }

    public function orders () {
        return $this->hasMany(Order::class,'user_id','id');
    }


    public function rates () {
        return $this->hasMany(Rate::class,'user_id','id');
    }


    protected $fillable = [
        'username', 'email', 'password', 'phone','image',
        'verified','reset_password_code','code_expiration_date',
        'fcm_token','status',
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
