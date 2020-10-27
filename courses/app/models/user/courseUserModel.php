<?php

namespace App\models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class courseUserModel extends Model
{
    public static function getAllCourses()
    { 
        return DB::table('user_courses_rate_view')->select('course_id','course_photo','avg_rate_c','institute_name_ar','course_name_ar','institute_name','course_name','course_price','course_details','course_details_ar')->paginate(12);

    }

    public static function getAllCourseTypes()
    {
        return DB::select("SELECT * FROM course_type ORDER BY course_type_name");
    }

    public static function getCourseDetails($course_id)
    {
        return DB::table('user_courses_rate_view')->select('*')->where("course_id",$course_id)->first();
    }
    public static function getInstituteAVG($institute_id)
    {
        return DB::table('user_institute_rate_view')->select('avg_rate_i')->where("institute_id",$institute_id)->pluck('avg_rate_i')->first();
    }
    public static function getCountRateInst($institute_id)
    {
        return DB::table('institute_rating')->where("institute_id",$institute_id)->count('institute_id');
    }

    public static function getCountRateCourse($course_id)
    {
        return DB::table('course_rating')->where("course_id",$course_id)->count('course_id');
    }

    public static function getCourseReciption($course_id)
    {
        return DB::select("SELECT * FROM airport_rec WHERE course_id = ? ORDER BY airport_rec_name",[$course_id]);

    }
    public static function getCourseLiving($course_id)
    {
        return DB::select("SELECT * FROM living WHERE course_id = ? ORDER BY living_name",[$course_id]);
    }
    public static function getCourseInsurance($course_id)
    {
        return DB::select("SELECT * FROM medical_insurance WHERE course_id = ? ORDER BY medical_insurance_name",[$course_id]);

    }

    public static function getCourseSearch($whereConditions,$orWhereAr,$sortCondition)
    {
        // DB::enableQueryLog(); 
        return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price','course_details','course_details_ar')->where($whereConditions)->orWhere($orWhereAr)->orderBy($sortCondition->cloumn,$sortCondition->sortBy)->paginate(12);
        //  dd(DB::getQueryLog());
    }

    public static function checkWish($course_id,$student_id)
    {
        return DB::select('SELECT * FROM `user_liked_view` WHERE course_id = ? AND student_id = ? ', [$course_id,$student_id]);

    }
    

   
    
    
}
