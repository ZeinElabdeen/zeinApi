<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class galleryModel extends Model
{
    //
    public static function allPhotos()
    {
        return DB::table('photos')->select('*')->paginate(6);
    }
    public static function allVedios()
    {
        return DB::table('videos')->select('*')->paginate(6);
    }
    public static function addPhoto($data)
    {
        return DB::insert('INSERT iNTO photos (photo_name, photo_title,photo_title_ar) values (?, ?, ?)',
         [$data->photo_name,$data->photo_title,$data->photo_title_ar]);
    }
    public static function addvedio($data)
    {
        return DB::insert('INSERT iNTO videos (cover_photo, video_url,video_title,video_title_ar) values (?, ?, ? ,?)',
         [$data->cover_photo,$data->video_url,$data->video_title,$data->video_title_ar]);
    }
    public static function showVideo($id)
    {
        return DB::select('SELECT * FROM videos WHERE video_id = ?', [$id]);
    }
    public static function showphoto($id)
    {
        return DB::select('SELECT * FROM photos WHERE photo_id = ?', [$id]);
    }
    public static function getVedioCover($id)
    {
        $photoCover =  DB::table('videos')->select('cover_photo')->where('video_id',$id)->pluck('cover_photo')->first();
        return $photoCover;
    }
    public static function getVedioUrl($id)
    {
        $videourl =  DB::table('videos')->select('video_url')->where('video_id',$id)->pluck('video_url')->first();
        return $videourl;
    }
    public static function updatevideo($data ,$id)
    {
        return DB::table('videos')->where('video_id',$id)->update($data);
    }
    public static function updateImage($data ,$id)
    {
        return DB::table('photos')->where('photo_id',$id)->update($data);
    }

    public static function getoldPhoto($id)
    {
        $photo =  DB::table('photos')->select('photo_name')->where('photo_id',$id)->pluck('photo_name')->first();
        return $photo;
    }
    public static function deleteVideo($id)
    {
        $data = DB::table('videos')->select('*')->where('video_id', '=', $id)->first();
        DB::table('videos')->where('video_id', '=', $id)->delete();
        return $data;
    }
    public static function deletephoto($id)
    {
        $photoName =  DB::table('photos')->select('photo_name')->where('photo_id',$id)->pluck('photo_name')->first();
        DB::table('photos')->where('photo_id', '=', $id)->delete();
        return $photoName;
    }
}
