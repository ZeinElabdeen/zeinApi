<?php

namespace App\models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class staticPageModel extends Model
{
    //
    public static function showPhoto()
    {
        return DB::table('photos')->select('*')->paginate(2);
    }
    public static function getWishlist($student_id)
    {
        return DB::table('user_student_whislist')->select('course_id','course_photo','course_name_ar','course_name','avg_rate_c','institute_name_ar','institute_name','course_price','course_details','course_details_ar')->where('student_id','=',$student_id)->paginate(3);
    }
    public static function checkWish($course_id,$student_id)
    {
        return DB::select('SELECT * FROM `user_liked_view` WHERE course_id = ? AND student_id = ? ', [$course_id,$student_id]);

    }
    public static function addWishlist($course_id,$student_id)
    {
        return DB::insert('INSERT INTO wishlist (student_id, course_id) VALUES (?, ?)', [$student_id, $course_id]);
    }
    public static function removeWish($course_id,$student_id)
    {
        return DB::delete("DELETE FROM `wishlist` WHERE student_id = ? AND course_id = ? ",[$student_id,$course_id]);
    }

    public static function showVedio()
    {
        return DB::table('videos')->select('*')->paginate(2);
    }
    public static function termsAndCondition()
    {
        return DB::select('SELECT * FROM terms_conditions');
    }
    public static function typeOfMsg()
    {
        return DB::select('SELECT * FROM message_title');
    }
    public static function sendmsg($data)
    {
        return DB::insert('INSERT INTO contact_us (student_id, message_title_id , message) values (?, ?,?)',
        [$data->student_id, $data->message_title_id , $data->message]);
    }
    public static function getaboutUs()
    {
        return DB::table('pages')->select('*')->where('page_id',34)->first();
    }
    
    public static function partners($limit)
   {
        return DB::select('SELECT * FROM partners ORDER by partner_id LIMIT '. $limit.',4');
        // return DB::table('partners')->select('*')->paginate(4);


   }

   public static function countPart()
   {
        return DB::table('partners')->count('partner_id');
        // return DB::table('partners')->select('*')->paginate(4);


   }

   public static function social()
    {
        return DB::select('SELECT * FROM social_media');
    }
    public static function bankAccount()
    {
        return DB::select('SELECT * FROM bank_accounts ');
    }

    public static function getAllNotes($STID)
    {
        return DB::table('notes')->select('*')->where('student_id','=',$STID)->orderBy('note_created_at', 'DESC')->paginate(3);
    }

    public static function deleteNote($STID,$note_id)
    {   
        $photoName = DB::table('notes')->select('note_photo')->where([['note_id','=',$note_id],['student_id','=',$STID]])->pluck('note_photo')->first();
         DB::delete(' DELETE FROM notes WHERE student_id = ? AND note_id = ? ', [$STID,$note_id]);
         return $photoName;
    }
    public static function insertNote($data)
    {   return DB::table('notes')->insert($data);

    }

    public static function updateNote($STID,$note_id,$data)
    { 
        $photoName = DB::table('notes')->select('note_photo')->where([['note_id','=',$note_id],['student_id','=',$STID]])->pluck('note_photo')->first();
        DB::table('notes')->where([['note_id','=',$note_id],['student_id','=',$STID]])->update($data);
        return $photoName;
    }

    public static function getsliderindex()
    {
        return DB::select('SELECT * FROM slider ');
    }
    
    public static function getAdsApp()
    {
        return DB::table('ads_app')->select('*')->first();
    }

    public static function getInformation()
    {
        return DB::table('website_info')->select('*')->first();
    }

    

    
}
