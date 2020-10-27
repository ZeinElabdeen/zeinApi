<?php

namespace App\APIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class coursesApiModel extends Model
{


    public static function course_page()
    {

        return DB::table('user_courses_rate_view')->select('course_id','course_photo','avg_rate_c','institute_name_ar','course_name_ar','institute_name','course_name','course_price')->paginate(12);

    }
    public static function getCourseDetails($course_id)
    {
        return DB::select('SELECT *,(course_price/weeks_number) AS week_price FROM user_courses_rate_view WHERE course_id = ?', [$course_id]);
    }

    public static function courseDetailsLiving($course_id)
    {
        return DB::select('SELECT living_id,living_price,living_name_ar,living_name FROM living WHERE course_id = ?', [$course_id]);
    }

    public static function courseDetailsInsurance($course_id)
    {
        return DB::select('SELECT medical_insurance_id,medical_insurance_name_ar,medical_insurance_name,medical_insurance_price FROM medical_insurance WHERE course_id = ?', [$course_id]);
    }

    public static function courseDetailsAirport($course_id)
    {
        return DB::select('SELECT airport_rec_id,airport_rec_name_ar,airport_rec_name,airport_rec_price FROM airport_rec WHERE course_id = ?', [$course_id]);
    }

    public static function checkWish($course_id,$student_id)
    {
        return DB::select('SELECT * FROM `user_liked_view` WHERE course_id = ? AND student_id = ? ', [$course_id,$student_id]);
    }

    public static function getCourseSearch($whereConditions,$orWhere,$sortCondition)
    {
        return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price')->where($whereConditions)->orWhere($orWhere)->orderBy('avg_rate_c',$sortCondition)->paginate(12);
    }


    public static function getCourseSearch2($total = null,$whereConditions,$sortCondition)
    {
        if( isset($total['courseTypeFlag']) && is_null($total['locationFlag']) ){
            return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price')->where($whereConditions)->whereIn($total['course_type'],$total['course_type_arr'])->orderBy('avg_rate_c',$sortCondition)->paginate(12);
        }
        if( isset($total['locationFlag']) && is_null($total['courseTypeFlag']) ){
            return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price')->where($whereConditions)->whereIn($total['international_or_local'],$total['international_or_local_arr'])->orderBy('avg_rate_c',$sortCondition)->paginate(12);
        }
        if( isset($total['locationFlag']) && isset($total['courseTypeFlag']) ){
            return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price')->where($whereConditions)->whereIn($total['course_type'],$total['course_type_arr'])->orWhereIn($total['international_or_local'],$total['international_or_local_arr'])->orderBy('avg_rate_c',$sortCondition)->paginate(12);
        }
        if( is_null($total['locationFlag']) && is_null($total['courseTypeFlag']) ){
            return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price')->where($whereConditions)->paginate(12);
        }
    }


    public static function setCourseRate($data)
    {
       return DB::insert("INSERT INTO course_rating (course_rate_value,course_id,student_id) VALUES (?, ?, ?)",[$data->course_rate_value,$data->course_id,$data->student_id]);
    }
    public static function wishlist($student_id)
    {
        return DB::table('user_student_whislist')->select('course_id','course_photo','course_name_ar','course_name','avg_rate_c','institute_name_ar','institute_name','course_price')->where('student_id','=',$student_id)->paginate(12);
    }

    public static function addWishlist($data)
    {
        return DB::insert('INSERT INTO wishlist (student_id, course_id) VALUES (?, ?)', [$data->student_id, $data->course_id]);
    }

    public static function getGlobalSearch($whereConditions,$orWhereAr,$sortCondition)
    {
                // DB::enableQueryLog(); 

     return DB::table("user_courses_rate_view")->select('course_id','course_photo','avg_rate_c','institute_name','course_name','institute_name_ar','course_name_ar','course_price')->where($whereConditions)->orWhere($orWhereAr)->orderBy($sortCondition->cloumn,$sortCondition->sortBy)->paginate(12);
            //  dd(DB::getQueryLog());

    }


    public static function getAllCourseTypes($lang)
    {
       return DB::select('SELECT * FROM course_type ORDER BY course_type_name'.$lang);
    }

    public static function getAllCities($lang)
    {
       return DB::select('SELECT * FROM institutes_citites ORDER BY city_name'.$lang);
    }
    public static function getallCountries($lang)
    {
       return DB::select('SELECT * FROM institute_location ORDER BY country'.$lang);
    }

    
    public static function removeWish($wishlist)
    {
        return DB::delete("DELETE FROM `wishlist` WHERE student_id = ? AND course_id = ? ",[$wishlist->student_id,$wishlist->course_id]);
    }

    public static function getRateCount($course_id)
    {
        return DB::table('course_rating')->where('course_id', $course_id)->count();
    }

    

    


}
