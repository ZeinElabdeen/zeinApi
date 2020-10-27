<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class reservationsModel extends Model
{
    //
    public static function allReservation()
    {
        return DB::select('SELECT * FROM user_reservations_view WHERE end_date > now() AND reservation_status = 0 ORDER BY created_at');
    }
    public static function lastReservation()
    {
        return DB::select('SELECT * FROM user_reservations_view WHERE end_date < now()');
    }

    public static function allConfirmedReservation()
    {
        return DB::select('SELECT * FROM user_reservations_view WHERE reservation_status = 1 ORDER BY created_at');
    }

    public static function allCanceledReservation()
    {
        return DB::select('SELECT * FROM user_reservations_view WHERE reservation_status = 2 ORDER BY created_at');
    }

    public static function getAllReservations()
    {
        return DB::select('SELECT * FROM user_reservations_view ORDER BY created_at');
    }

    public static function getReservationDetails($reservation_id)
    {
        return DB::table('reservations')->select('*')->where('reservation_id','=',$reservation_id)->first();
    }

    public static function getAllST()
    {
        return DB::select('SELECT * FROM students ORDER BY student_id');
    }

    public static function getAllCourses()
    {
        return DB::select('SELECT * FROM courses ORDER BY course_name');
    }

    public static function getCourseResidences($course_id)
    {
        return DB::select('SELECT * FROM living WHERE course_id = ?  ORDER BY living_name ',[$course_id]);

    }

    public static function getCourseReceptions($course_id)
    {
        return DB::select('SELECT * FROM airport_rec WHERE course_id = ? ORDER BY airport_rec_name ',[$course_id]);

    }

    public static function getCourseInsurances($course_id)
    {

        return DB::select('SELECT * FROM medical_insurance  WHERE course_id = ? ORDER BY medical_insurance_name',[$course_id]);

    }
    public static function insertReservation($reservation_id,$data)
    {
        return DB::table('reservations')->where('reservation_id',$reservation_id)->update($data);
    }

    public static function confirmStatus($id)
    {
        return DB::update('UPDATE reservations set reservation_status = ? WHERE reservation_id = ?', [1,$id]);
    }

    public static function updateTitle($reservation_id,$content)
    {
        return DB::update('UPDATE reservation_noti set title = ? , title_ar = ? , details = ?  , details_ar  = ? WHERE reservation_id = ?', [$content['title'],$content['title_ar'],$content['details'],$content['details_ar'],$reservation_id]);
    }

    
    public static function cancelStatus($id)
    {
        return DB::update('UPDATE reservations set reservation_status = ? WHERE reservation_id = ?', [2,$id]);
    }
    public static function deleteRservation($id)
    {
        return DB::delete('DELETE FROM reservations WHERE reservation_id = ?', [$id]);
    }

    public static function getStudentData($student_id)
    {
        return DB::table('students')->select('*')->where('student_id',$student_id)->first();
    }
    public static function getSTID($reservation_id)
    {
        return DB::table('reservations')->select('student_id')->where('reservation_id',$reservation_id)->pluck('student_id')->first();
    }

    public static function getReservationData($reservation_id)
    {
        return DB::table('reservations')->select('*')->where('reservation_id',$reservation_id)->first();
    }

    public static function allStudents()
    {
        return DB::table('students')->select('*')->orderBy('student_id')->get();
    }
    public static function allCourses()
    {
        return DB::table('courses')->select('*')->orderBy('course_id')->get();
    }

    public static function allLiving($course_id)
    {
        return DB::table('living')->select('*')->where('course_id',$course_id)->get();

    }

    public static function allInsurances($course_id)
    {
        return DB::table('medical_insurance')->select('*')->where('course_id',$course_id)->get();

    }

    public static function allReceptions($course_id)
    {
        return DB::table('airport_rec')->select('*')->where('course_id',$course_id)->get();
    }

    public static function addReservation($data)
    {
       return DB::table('reservations')->insert($data);
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

    public static function markNoti($reservation_id)
    {
        return DB::table('reservation_admin_noti')->where('reservation_id',$reservation_id)->update(['read_at'=>1]);
    }

    public static function getFCM($STID)
    {
        return DB::table('students')->select('fcm_token')->where('student_id',$STID)->pluck('fcm_token')->first();
    }

    

    
}
