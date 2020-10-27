<?php

namespace App\APIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class institutesApiModel extends Model
{

    public static function institute_page()
    {
        return DB::table('user_institute_rate_view')->select('institute_id','institutes_photo','avg_rate_i','institute_name_ar','country_ar','city_name_ar','institute_details_ar','institute_name','country','city_name','institute_details')->paginate(12);
    }

    public static function count_of_courses($institute_id)
    {
        return DB::table('courses')->where('institute_id','=', $institute_id)->count('course_id');
    }  

    public static function getInstituteDetails($institute_id)
    {
        return DB::select('SELECT institute_id,institute_name_ar,institute_details_ar,institutes_photo,country_ar,city_name_ar,avg_rate_i,institute_name,institute_details,country,city_name FROM user_institute_rate_view WHERE institute_id = ?', [$institute_id]);
    }
    public static function get_institute_courses($institute_id)
    {
        return DB::select('SELECT course_id,course_photo,avg_rate_c,institute_name_ar,course_name_ar,institute_name,course_name,course_price FROM user_courses_rate_view WHERE institute_id = ? ',[$institute_id]);
    }

    public static function get_institute_online($institute_id)
    {
        return DB::select('SELECT online_course_id,online_course_name_ar,online_course_details_ar,online_course_name,online_course_details,online_course_link,online_course_photo,institute_name_ar,institute_name FROM user_online_course_view WHERE institute_id = ? ',[$institute_id]);
    }
  
    public static function getInstituteSearch($whereConditions,$total,$sortCondition)
    {

        // return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','country','city_name','institute_details','institute_name_ar','country_ar','city_name_ar','institute_details_ar')->where($whereConditions)->orderBy('avg_rate_i',$sortCondition)->paginate(12);

        if( isset($total['countryFlag']) && is_null($total['cityFlag']) ){
            return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','country','city_name','institute_details','institute_name_ar','country_ar','city_name_ar','institute_details_ar')->where($whereConditions)->whereIn($total['location_id'],$total['country_arr'])->orderBy('avg_rate_i',$sortCondition)->paginate(12);
        }
        if( isset($total['cityFlag']) && is_null($total['countryFlag']) ){
            return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','country','city_name','institute_details','institute_name_ar','country_ar','city_name_ar','institute_details_ar')->where($whereConditions)->whereIn($total['city_id'],$total['city_arr'])->orderBy('avg_rate_i',$sortCondition)->paginate(12);
        }
        if( isset($total['cityFlag']) && isset($total['countryFlag']) ){
            return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','country','city_name','institute_details','institute_name_ar','country_ar','city_name_ar','institute_details_ar')->where($whereConditions)->whereIn($total['city_id'],$total['city_arr'])->orWhereIn($total['location_id'],$total['country_arr'])->orderBy('avg_rate_i',$sortCondition)->paginate(12);
        }
        if( is_null($total['cityFlag']) && is_null($total['countryFlag']) ){
        return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','country','city_name','institute_details','institute_name_ar','country_ar','city_name_ar','institute_details_ar')->where($whereConditions)->orderBy('avg_rate_i',$sortCondition)->paginate(12);
        }

    }


    public static function getInstituteSearch2($whereConditions,$sortCondition)
    {

        return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','country','city_name','institute_details','institute_name_ar','country_ar','city_name_ar','institute_details_ar')->where($whereConditions)->orderBy('avg_rate_i',$sortCondition)->paginate(12);

    }





    public static function setInstituteRate($data)
    {
       return DB::insert("INSERT INTO institute_rating (institute_rate_value,institute_id,student_id) VALUES (?, ?, ?)",[$data->institute_rate_value,$data->institute_id,$data->student_id]);
    }

    public static function getAllCountries($lang)
    {
        return DB::select('SELECT * FROM institute_location ORDER BY country'.$lang);

    }

    public static function getInstituteCountRate($institute_id)
    {
        return DB::table('institute_rating')->where('institute_id', $institute_id)->count();
    }


}
