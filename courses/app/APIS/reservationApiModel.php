<?php

namespace App\APIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reservationApiModel extends Model
{

    public static function reserve($data)
    {
        return DB::insert('INSERT INTO reservations (course_id,student_id,living_id,airport_rec_id,medical_insurance_id,start_at,reserved_weeks_number,coupon,created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [$data->course_id,$data->student_id,$data->living_id,$data->airport_rec_id,$data->medical_insurance_id,$data->start_at,$data->reserved_weeks_number,$data->coupon,date("Y-m-d H:i:s")]);
    }

    public static function updatePassport($data)
    {
        return DB::update('UPDATE students SET student_passport_name = ? , student_passport_number = ? , passport_photo = ? where student_id = ?',
         [$data->student_passport_name,$data->student_passport_number,$data->passport_photo,$data->student_id]);
    }

    public static function mycurrentReservation($student_id)
    {
        return DB::table('user_reservations_view')->select('reservation_id','course_name_ar','course_details_ar','course_name','course_details','total','course_photo','created_at','start_at','reserved_weeks_number')->where([['student_id','=',$student_id],['end_date','>',now()]])->paginate(12);

    }
    public static function mylastReservation($student_id)
    {
        return DB::table('user_reservations_view')->select('reservation_id','course_name_ar','course_details_ar','course_name','course_details','total','course_photo','created_at','start_at','reserved_weeks_number')->where([['student_id','=',$student_id],['end_date','<',now()]])->paginate(12);

    }

    public static function reservDetails($reservation_id,$student_id)
    {
        return DB::select('SELECT * FROM user_reservations_view WHERE reservation_id = ? AND student_id = ?', [$reservation_id,$student_id]);
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
