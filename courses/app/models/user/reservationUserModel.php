<?php

namespace App\models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reservationUserModel extends Model
{
    public static function mycurrentReservation($student_id)
    {
        return DB::table('user_reservations_view')->select('reservation_id','course_name_ar','course_details_ar','course_name','course_details','total','course_photo','created_at','start_at','reserved_weeks_number')->where([['student_id','=',$student_id],['end_date','>',now()]])->paginate(3);

    }
    public static function mylastReservation($student_id)
    {
        return DB::table('user_reservations_view')->select('reservation_id','course_name_ar','course_details_ar','course_name','course_details','total','course_photo','created_at','start_at','reserved_weeks_number')->where([['student_id','=',$student_id],['end_date','<',now()]])->paginate(3);

    }
    public static function checkPassport($student_id)
    {
        return DB::table('students')->select('student_passport_number')->where('student_id','=',$student_id)->pluck('student_passport_number')->first();

    }

    public static function addreserve($data)
    {
       return DB::table('reservations')->insertGetId($data);
    }

    public static function getReserve($student_id,$reservation_id)
    {
        return DB::select('SELECT * FROM user_reservations_view WHERE student_id = ? AND reservation_id = ? ',[$student_id,$reservation_id]);
    }

    public static function getCourseReserve($student_id,$reservation_id)
    {
        return DB::table('user_reservations_view')->select('*')->where([['student_id' , '=' , $student_id],['reservation_id' , '=' , $reservation_id]])->first();
    }

    public static function getSTData($student_id)
    {
        return DB::table('students')->select('*')->where('student_id' , '=' , $student_id)->first();
    }
    
     public static function getReserveMail($student_id,$reservation_id)
    {
        return DB::table('user_reservations_view')->select('*')->where([['student_id' , '=' , $student_id],['reservation_id' , '=' , $reservation_id]])->first();
    }
    public static function getLogo()
    {
        return DB::table('website_info')->select('logo2')->pluck('logo2')->first();

    }
    public static function getWebsite()
    {
        return DB::table('website_info')->select('*')->first();

    }
    public static function getSocial()
    {
        return DB::table('social_media')->select('*')->get();

    }


    
}
