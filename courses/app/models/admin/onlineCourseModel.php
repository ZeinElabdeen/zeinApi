<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class onlineCourseModel extends Model
{
    //
    public static function addCourseOnline($data)
    {
        return DB::insert('INSERT INTO online_courses (online_course_name, online_course_name_ar,online_course_details,online_course_details_ar,online_course_link,institute_id,online_course_photo) values (?, ?, ?, ?, ?, ?, ?)',
         [$data->online_course_name,$data->online_course_name_ar,$data->online_course_details,$data->online_course_details_ar,$data->online_course_link,$data->institute_id,$data->online_course_photo]);
    }
    public static function allCourses()
    {
        return DB::select('SELECT * FROM user_online_course_view ');
    }

    public static function onlineCoursesdetails($id)
    {
        return DB::table('user_online_course_view')->select('*')->where('online_course_id','=',$id)->first();
    }
    public static function updateOnlineCourse($data,$id)
    {
        return DB::table('online_courses')->where('online_course_id',$id)->update($data);
        // return DB::update('UPDATE online_courses SET online_course_name = ?, online_course_name_ar = ?, online_course_details = ? , online_course_details_ar = ? , online_course_link = ? , institute_id = ? ,online_course_photo =? where online_course_id = ?',
        //  [$data['online_course_name'],$data['online_course_name_ar'],$data['online_course_details'],$data['online_course_details_ar'],$data['online_course_link'],$data['institute_id'],$data['online_course_photo'],$id]);
    }
    public static function getOnlineCoursePhoto($id)
    {
        $photoName = DB::table('online_courses')->select('online_course_photo')->where('online_course_id',$id)->pluck('online_course_photo')->first();
        return $photoName;
    }

    // public static function updateOnlineCourse($online_course_name,$online_course_name_ar,$online_course_details,$online_course_details_ar,$online_course_link,$institute_id,$online_course_photo,$id)
    // {
    //     return DB::update('UPDATE online_courses SET online_course_name = ?, online_course_name_ar = ?, online_course_details = ? , online_course_details_ar = ? , online_course_link = ? , institute_id = ? ,online_course_photo =? where online_course_id = ?',
    //      [$online_course_name,$online_course_name_ar,$online_course_details,$online_course_details_ar,$online_course_link,$institute_id,$online_course_photo,$id]);
    // }
    public static function deleteOnlineCourse($id)
    {
        $photoName =  DB::table('online_courses')->select('online_course_photo')->where('online_course_id',$id)->pluck('online_course_photo')->first();
        DB::table('online_courses')->where('online_course_id', '=', $id)->delete();
        return $photoName;
    }


//     public static function deleteCourse($course_id)
//    {
//      $photoName =  DB::table('courses')->select('course_photo')->where('course_id',$course_id)->pluck('course_photo')->first();
//      DB::table('courses')->where('course_id', '=', $course_id)->delete();
//      return $photoName;

//   }
}
