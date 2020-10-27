<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class coursesModel extends Model
{
   public static function getAllCourses()
   {
     return DB::select('SELECT * FROM user_courses_view ORDER BY course_name');
    // return DB::table('courses')->select('*')->orderBy('course_id','desc');
   }

   public static function getCourseDetails($course_id)
   {
    // return DB::select('SELECT *,(course_price/weeks_number) AS week_price FROM user_courses_rate_view WHERE course_id = ?', [$course_id]);
    return DB::table('user_courses_rate_view')->select('*')->where('course_id','=',$course_id)->first();

   }

   public static function getAllCourseTypes()
   {
    return DB::select('SELECT * FROM course_type ORDER BY course_type_name');

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

   public static function getCourseRates($course_id)
   {
    return DB::select('SELECT * FROM admin_courses_user_rates  WHERE course_id = ? ORDER BY rate_created_at',[$course_id]);
   }

   public static function getratecourse($id)
   {
       return DB::table('course_rating')->select(DB::raw('CEILING(avg(course_rate_value)) AS avg_rate ,course_id'))->where('course_id','=',$id)->groupBy('course_id')->get();
   }

   public static function updateCourse($courseData,$course_id)
   {
     return DB::table('courses')->where('course_id',$course_id)->update($courseData);
   }

   public static function updateLiving($living_id,$living_name,$living_name_ar,$living_price,$course_id)
   {
    return DB::update("UPDATE `living` SET living_name = ?,living_name_ar = ? ,living_price = ?  WHERE course_id = ? AND living_id = ? ",
    [$living_name,$living_name_ar,$living_price,$course_id,$living_id]);
   }

   public static function updateInsurance($insuranceData,$course_id)
   {
    return DB::update('UPDATE medical_insurance SET medical_insurance_price = ? WHERE course_id = ? ',[$insuranceData['medical_insurance_price'],$course_id]);
   }

   public static function updateReception($receptionData,$course_id)
   {
    return DB::update('UPDATE airport_rec SET airport_rec_price = ? WHERE course_id = ? ',[$receptionData['airport_rec_price'],$course_id]);
   }

   public static function insertCourse($courseData)
   {
     return DB::table('courses')->insertGetId($courseData);
   }


   public static function insertInsurance($insuranceData)
   {
     return DB::table('medical_insurance')->insert($insuranceData);
   }

   public static function insertReception($receptionData)
   {
     return DB::table('airport_rec')->insert($receptionData);
   }

   public static function insertLiving($residenceData)
   {
     return DB::table('living')->insert($residenceData);
   }

   public static function deleteCourse($course_id)
   {
     $photoName =  DB::table('courses')->select('course_photo')->where('course_id',$course_id)->pluck('course_photo')->first();
     DB::table('courses')->where('course_id', '=', $course_id)->delete();
     return $photoName;
    
  }


  public static function getCoursePhoto($course_id)
  {
    $photoName =  DB::table('courses')->select('course_photo')->where('course_id',$course_id)->pluck('course_photo')->first();
    return $photoName;
 }
   

   

   
   
}
