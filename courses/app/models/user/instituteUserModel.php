<?php

namespace App\models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class instituteUserModel extends Model
{
    //
    public static function getAllInstitute()
    {
        return DB::table('user_institute_rate_view')->select('institute_id','institutes_photo','avg_rate_i','institute_name','institute_name_ar','country','country_ar','city_name','city_name_ar','institute_details','institute_details_ar')->paginate(12);
    }
    public static function getInstituteInfo($id)
    {
        return DB::table('user_institute_rate_view')->select('institute_id','institutes_photo','avg_rate_i','institute_name','institute_name_ar','country','country_ar','city_name','city_name_ar','institute_details','institute_details_ar')->where('institute_id','=',$id)->first();

    }
    public static function getInstituteCourse($id)
    {
        return DB::select('SELECT * FROM user_courses_rate_view where institute_id = ?', [$id]);
    }
    public static function getinstituteCourseOnline($id)
    {
        # code...  user_online_course_view
        return DB::select('SELECT * FROM user_online_course_view where institute_id = ?', [$id]);

    }

    public static function getCountRateInst($institute_id)
    {
        return DB::table('institute_rating')->where("institute_id",$institute_id)->count('institute_id');
    }
    public static function getNoCoursesOfInst($institute_id)
    {
        return DB::table('courses')->where("institute_id",$institute_id)->count('institute_id');

    }

    public static function getInstituteSearch($whereConditions,$orWhereAr,$sortCondition)
    {
        return DB::table("user_institute_rate_view")->select('institute_id','institutes_photo','avg_rate_i','institute_name','institute_name_ar','country','country_ar','city_name','city_name_ar','institute_details','institute_details_ar')->where($whereConditions)->orWhere($orWhereAr)->orderBy($sortCondition->cloumn,$sortCondition->sortBy)->paginate(12);
    }

    public static function getAllCountries()
    {
        return DB::select('SELECT * FROM institute_location ORDER BY country');
    }

    public static function getAllCities()
    {
        return DB::select('SELECT * FROM institutes_citites ORDER BY city_name');
    }


    
    
    

}
