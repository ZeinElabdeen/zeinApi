<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

//use Illuminate\Database\Eloquent\Model;

class Users extends Authenticatable
{

    protected $table = 'users';

    protected $fillable = ['type','full_name', 'username', 'phone','password','image',
                            'reset_password_code','code_expiration','address','email'
                            ,'status','verified','remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


 public static function randToken () {

//	   return rand(10000,99999);

	 $id = str_random(10);
     $validator = \Validator::make(['id'=>$id],['id'=>'unique:users,verified']);
     if($validator->fails()){
          return $this->randomId();
     }
     return $id;


  }

}
