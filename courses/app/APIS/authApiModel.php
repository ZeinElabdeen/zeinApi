<?php

namespace App\APIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class authApiModel extends Model
{
    public static function insertST($data)
    {
        
        DB::insert('INSERT INTO students (student_name, student_email,student_phone,student_password,activation_code,access_token) values (?, ?, ?, ?, ?, ?)',
        [$data->student_name,$data->student_email,$data->student_phone,$data->student_password,$data->activation_code,$data->access_token]);
        $last_id = DB::getPdo()->lastInsertId();
        return $last_id;
    }

    public static function updateAccessToken ($access_token,$student_id){
        DB::update('UPDATE students SET access_token = ? WHERE student_id = ?', [$access_token,$student_id]);
    }

    public static function activateST($data)
    {
        return DB::table('students')->where('student_id' , '=' , $data->student_id)->avg('activation_code');
       
    }
    public static function updateActivationST($data)
    {
        return DB::update('UPDATE students SET verification = ? WHERE student_id = ?', [1,$data->student_id]);
    }
    public static function resendActivation($data)
    {
        return DB::update('UPDATE students SET activation_code = ? WHERE student_id = ?', [$data->activation_code,$data->student_id]);
    }
    public static function getPassword($data)
    {
          
        return  DB::select('SELECT * FROM students WHERE student_phone = ?', [$data->student_phone]);
       
    }

    public static function getSTID($data)
    {
        return DB::table('students')->select('student_id')->where('student_phone','=',$data->student_phone)->first();
    } 


    public static function setNewPassword($data)
    {
        return DB::update('UPDATE students SET student_password = ? WHERE student_id = ?', [$data->student_password,$data->student_id]);

    }


    public static function getProfile($student_id)
    {
        return DB::table('students')->select('student_name','student_phone','student_email','student_password')->where('student_id','=',$student_id)->first();
    }

    public static function updateProfileData($data)
    {
       return DB::update('UPDATE students SET student_email = ?,student_name = ?  WHERE student_id = ?', [$data->student_email,$data->student_name,$data->student_id]);
    }

    public static function STID($access_token)
    {
        return DB::table('students')->select('student_id')->where('access_token' , '=' , $access_token)->value('student_id');;
    }

    
    public static function logout($access_token)
    {
       return DB::update('UPDATE students SET access_token = null WHERE access_token = ?', [$access_token]);
    }

    public static function getAllUsers()
    {
       return DB::select('SELECT * FROM students WHERE access_token <> null');
    }

    public static function updateFCM($fcm_token,$student_id)
    {
       return DB::update('UPDATE students SET fcm_token = ? WHERE student_id = ?',[$fcm_token,$student_id]);
    }

    public static function updateLang($lang,$student_id)
    {
       return DB::update('UPDATE students SET mob_lang = ? WHERE student_id = ?',[$lang,$student_id]);
    }

    

    public static function getFCM($student_id)
    {
        return DB::table('students')->select('fcm_token')->where('student_id',$student_id)->pluck('fcm_token')->first();
    }

    public static function getAllNotifications($student_id)
    {
         return DB::table('reservation_noti')->select('*')->where('student_id',$student_id)->get();
    }
    

    


}
