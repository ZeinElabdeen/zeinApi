<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class indexModel extends Model
{
   public static function recentInst()
   {
        return DB::select('SELECT * FROM user_institutes_view ORDER BY i_created_at DESC LIMIT 3');
   }
   public static function recentCourses()
   {
        return DB::select('SELECT * FROM user_courses_view ORDER BY c_created_at DESC LIMIT 3');
   }
   public static function partners()
   {
        return DB::select('SELECT * FROM partners ORDER BY LIMIT 4');
   }
   public static function noOfCourses()
   {
       return DB::table('courses')->select('*')->count();
   }
   public static function noOfInstitute()
   {
    return DB::table('institutes')->select('*')->count();
   }
   public static function noOfOnlineCourse()
   {
    return DB::table('online_courses')->select('*')->count();
   }
   public static function noOfStudent()
   {
    return DB::table('students')->select('*')->count();
   }
   public static function noOfAllReservation()
   {
    return DB::table('reservations')->select('*')->count();
   }
   public static function noOfConfirmed()
   {
    return DB::table('reservations')->select('*')->where('reservation_status',1)->count();
   }
   public static function noOfCancel()
   {
    return DB::table('reservations')->select('*')->where('reservation_status',2)->count();
   }
   public static function noOfcompelete()
   {
    return DB::table('user_reservations_view')->select('*')->where('end_date','<',now())->count();
   }
   public static function noOfPending()
   {
    return DB::table('reservations')->select('*')->where('reservation_status',0)->count();
   }
   public static function mostInstitute()
   {
         return DB::select('SELECT course_id ,course_name , COUNT(*) as maximum FROM  user_reservations_view GROUP BY course_id ORDER BY maximum DESC LIMIT 1');
   }
   public static function pendingMsg()
   {
        return DB::table('contact_us')->select('*')->where('message_reply',null)->count();
   }
   public static function replyedMsg()
   {
        return DB::table('contact_us')->select('*')->where('message_reply','<>',null)->count();
   }
   public static function getProfile($id)
   {
        return DB::table('admin')->select('*')->where('id',$id)->first();
   }
   public static function updateData($data,$id)
   {
        return DB::table('admin')->where('id',$id)->update($data);
   }
   public static function insertData($data)
   {
        return DB::table('admin')->insert($data);
   }
   public static function getAllAdmins()
   {
        return DB::table('admin')->select('*')->get();
   }
   public static function deleteAdmin($id)
   {
        return DB::table('admin')->where('id',$id)->delete();
   }

   public static function updatePassword($user,$id)
   {
        return DB::table('admin')->where('id',$id)->update($user);
   }

   
   
}
