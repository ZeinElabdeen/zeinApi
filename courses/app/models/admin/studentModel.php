<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class studentModel extends Model
{
    //
    public static function allstudent()
    {
        return DB::select('SELECT * FROM students');
    }
    public static function deleteStudent($student_id)
    {
        $photoName =  DB::table('students')->select('passport_photo')->where('student_id',$student_id)->pluck('passport_photo')->first();
        DB::table('students')->where('student_id', '=', $student_id)->delete();
        return $photoName;
    }
    public static function STStatus($id,$st)
    {
        return DB::update('UPDATE students SET verification = ? where student_id = ?', [$st,$id]);
        // return !$st;
    }
    public static function addStudent($data)
    {
        return DB::insert('INSERT INTO students (student_name, student_email,student_phone,student_password,student_passport_name,student_passport_number,passport_photo)
         values (?, ?, ?, ?, ?, ?, ?)', [$data->student_name,$data->student_email,$data->student_phone,$data->student_password,$data->student_passport_name,$data->student_passport_number,$data->passport_photo]);
    }
    public static function profileStudent($id)
    {
        return DB::table('students')->select('*')->where('student_id','=',$id)->first();
        // return DB::select('SELECT * FROM students where student_id = ?', [$id]);
    }
    public static function studentCourses($id)
    {
        return DB::select('SELECT * FROM user_reservations_view where student_id = ?', [$id]);
    }
    public static function rateOfStudent($id)
    {
        return DB::select('SELECT * FROM admin_courses_user_rates where student_id = ?', [$id]);
    }
    public static function studentWishlist($id)
    {
        return DB::select('SELECT * FROM user_student_whislist where student_id = ?', [$id]);
    }
    public static function updateProfile($STData,$id)
    {
        return DB::update("UPDATE `students` SET student_name = ?,student_phone = ? ,student_email = ?,student_passport_name = ? ,student_passport_number = ? ,passport_photo = ? WHERE student_id = ?",
        [$STData['student_name'],$STData['student_phone'],$STData['student_email'],$STData['student_passport_name'],$STData['student_passport_number'],$STData['passport_photo'],$id]);
    }
    public static function deleteCourse($id)
    {
        return DB::delete('DELETE FROM courses WHERE course_id = ?', [$id]);
    }

    public static function studentNote($id)
    {
        return DB::select('SELECT * FROM notes where student_id = ?', [$id]);
    }
    public static function deleteNote($STID,$note_id)
    {
        $photoName = DB::table('notes')->select('note_photo')->where([['note_id','=',$note_id],['student_id','=',$STID]])->pluck('note_photo')->first();
         DB::delete(' DELETE FROM notes WHERE student_id = ? AND note_id = ? ', [$STID,$note_id]);
         return $photoName;
    }
    public static function insertNote($data)
    {
        return DB::table('notes')->insert($data);

    }

    public static function updateNote($STID,$note_id,$data)
    {
        $photoName = DB::table('notes')->select('note_photo')->where([['note_id','=',$note_id],['student_id','=',$STID]])->pluck('note_photo')->first();
        DB::table('notes')->where([['note_id','=',$note_id],['student_id','=',$STID]])->update($data);
        return $photoName;
    }

}
