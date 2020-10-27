<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class courseTypesModel extends Model
{
    public static function getAllCourseTypes () 
    {
        return DB::table('course_type')->select('*')->get();
    }

    public static function insertCourseType($data)
    {
      return DB::table('course_type')->insert($data);
  
    }
    
    public static function getCourseType($course_type_id)
    {
        return DB::table('course_type')->select('*')->where('course_type_id', '=', $course_type_id)->first();
    }
    
  
    public static function editCourseType($course_type_id,$data)
    {
        return DB::table('course_type')->where('course_type_id',$course_type_id)->update($data);
    }

    public static function deleteCourseType($course_type_id)
    {
        return DB::table('course_type')->where('course_type_id', '=', $course_type_id)->delete();
    }
}
