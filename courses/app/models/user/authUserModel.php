<?php

namespace App\models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class authUserModel extends Model
{
   public static function getPassword($data)
   {
    return  DB::select('SELECT * FROM students WHERE student_phone = ?', [$data->student_phone]);
   }
   public static function getProfile($student_id)
   {
      return  DB::table('students')->select('*')->where('student_id',$student_id)->first();
   }

   public static function register($data)
   {
      return DB::table('students')->insertGetId($data);
   }

   public static function updatePassport($data,$STID)
   {
      return DB::table('students')->where('student_id',$STID)->update($data);
   }
   public static function getCode($data)
   {
      return  DB::table('students')->select('activation_code')->where('student_id',$data['student_id'])->pluck('activation_code')->first();

   }

   public static function updateVerificationStatus($data)
    {
        return DB::update('UPDATE students SET verification = ? WHERE student_id = ?', [1,$data['student_id']]);
    }
  
   public static function updateActivationCode($data)
   {
        DB::update('UPDATE students SET activation_code = ? WHERE student_phone = ? ',[$data['activation_code'],$data['student_phone']]);
        return DB::table('students')->select('*')->where('student_phone',$data['student_phone'])->first();
   }

   public static function resetPasswordSignture($token,$user_id)
   {
      return DB::insert('INSERT INTO pass_resets (`student_id`, `reset_token`) VALUES (?,?)',[$user_id,$token]);
   }
   public static function resetPassword($data)
   {
      DB::update('UPDATE students SET student_password = ? WHERE student_id = ?', [$data['student_password'],$data['student_id']]);
      return DB::table('students')->select('*')->where('student_id',$data['student_id'])->first();

   }

   
   
}
