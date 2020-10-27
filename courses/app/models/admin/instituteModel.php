<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class instituteModel extends Model
{
    //
    public static function cities()
    {
        return DB::select('SELECT * FROM institutes_citites');
    }
    public static function countries()
    {
        return DB::select('SELECT * FROM institute_location');
    }
    public static function addInstitute($data)
    {
        return DB::insert('INSERT INTO institutes (institute_name, institute_name_ar ,institute_details,institute_details_ar,institutes_photo,location_id,city_id,institute_email)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [$data->institute_name,$data->institute_name_ar,$data->institute_details,$data->institute_details_ar,$data->institutes_photo,$data->location_id,$data->city_id,$data->institute_email]);
    }
    public static function allInstitute()
    {
        return DB::select('SELECT * FROM institutes');
    }
    public static function deleteInst($institute_id)
    {
        $photoName =  DB::table('institutes')->select('institutes_photo')->where('institute_id',$institute_id)->pluck('institutes_photo')->first();
        DB::table('institutes')->where('institute_id', '=', $institute_id)->delete();
        return $photoName;
    }
    public static function instituteDetails($id)
    {
        return DB::table('user_institute_rate_view')->select('*')->where('institute_id','=',$id)->first();
    }
    public static function getRateInstitute($id)
    {
        return DB::select('SELECT CEILING(avg(institute_rate_value)) AS avg_rate_i ,institute_id FROM `institute_rating` WHERE institute_id=? GROUP BY institute_id', [$id]);
    }
    public static function studentRate($id)
    {
        return DB::select('SELECT * FROM admin_institute_rateuser WHERE institute_id = ?', [$id]);
        // return DB::table('admin_institute_rateuser')->select('*')->where('institute_id','=',$id);
    }
    public static function instituteCourse($id)
    {
        return DB::select('SELECT * FROM courses where institute_id = ?', [$id]);
    }
    public static function instituteCourseOnline($id)
    {
        return DB::select('SELECT * FROM online_courses where institute_id = ?', [$id]);
    }
    public static function getInstitutePhoto($id)
    {
        $photoName =  DB::table('institutes')->select('institutes_photo')->where('institute_id',$id)->pluck('institutes_photo')->first();
        return $photoName;
    }
    public static function updateInstitute($data,$id)
    {
        return DB::table('institutes')->where('institute_id',$id)->update($data);
    }
//    public static function courses($id)
//    {
//         return DB::select('SELECT * FROM user_courses_rate_view WHERE course_id = ?',[$id]);
//    }
}
