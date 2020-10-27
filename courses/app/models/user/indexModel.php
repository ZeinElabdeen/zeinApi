<?php

namespace App\models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class indexModel extends Model
{
    public static function recentInst()
   {
        return DB::select('SELECT * FROM user_institute_rate_view ORDER BY i_created_at DESC LIMIT 3');
   }
   public static function recentCourses()
   {
        return DB::select('SELECT * FROM user_courses_rate_view ORDER BY c_created_at DESC LIMIT 3');
     // return DB::table('user_courses_rate_view')->select('course_id','course_photo','avg_rate_c','institute_name'.$lang,'course_name'.$lang,'course_price')->limit(3);

   }
   public static function partners()
   {
        return DB::select('SELECT * FROM partners ORDER BY LIMIT 4');
   }
}
