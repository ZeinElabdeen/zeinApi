<?php

namespace App\APIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class pagesApiModel extends Model
{
    public static function getPage($pageId)
    {
        return DB::table('pages')->select('*')->where('page_id','=',$pageId)->first();
    }
    public static function getAllNotes($STID)
    {
        return DB::table('notes')->select('*')->where('student_id','=',$STID)->orderBy('note_created_at', 'DESC')->paginate(12);
    }

    public static function getNoteDetails($noteId)
    {
        return DB::table('notes')->select('*')->where('note_id','=',$noteId)->first();
    }

    public static function insertNote($data)
    {
        return DB::insert('INSERT INTO notes (note_details, note_photo, student_id) VALUES (?, ?, ?)', [$data->note_details, $data->note_photo, $data->student_id]);
    }

    public static function editNote($data)
    {
        return DB::update('UPDATE notes SET note_details = ? , note_photo = ? WHERE note_id = ?  AND student_id = ?', [$data->note_details, $data->note_photo, $data->note_id,$data->student_id]);
    }

    public static function editNoteOnly($data)
    {
        return DB::update('UPDATE notes SET note_details = ?  WHERE note_id = ?  AND student_id = ?', [$data->note_details, $data->note_id,$data->student_id]);
    }

    public static function deletePhotoOnly($data)
    {
        return DB::update('UPDATE notes SET note_photo = null  WHERE note_id = ?  AND student_id = ?', [$data->note_id,$data->student_id]);
    }

    public static function deleteNote($STID,$note_id)
    {
        return DB::delete(' DELETE FROM notes WHERE student_id = ? AND note_id = ? ', [$STID,$note_id]);
    }
    
    

    

    


    public static function photos()
    {
        return DB::table('photos')->select('*')->paginate(12);
    }
    public static function vedios()
    {
        return DB::table('videos')->select('*')->paginate(12);
    }
    public static function termsandcond()
    {
        return DB::table('terms_conditions')->select('*')->get();
    }

    public static function getContact()
    {
       return DB::select("SELECT * FROM message_title ORDER BY message_title");
    }

    public static function getsocial()
    {
       return DB::select("SELECT * FROM social_media ORDER BY social_id");
    }
    
    public static function contact($data)
    {
        return DB::insert('INSERT INTO contact_us (student_id, message_title_id,message) VALUES (?, ?, ?)',
         [$data->student_id, $data->message_title_id , $data->message]);
    }
    public static function getBankAcc()
    {
        return DB::table('bank_accounts')->select('*')->get();
    }



    
}
