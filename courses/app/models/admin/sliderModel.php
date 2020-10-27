<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sliderModel extends Model
{
    public static function getAllSliders () 
    {
        return DB::table('slider')->select('*')->get();
    }

    public static function insertSlider($data)
    {
      return DB::table('slider')->insert($data);
  
    }
    
    public static function getSlider($slider_id)
    {
        return DB::table('slider')->select('*')->where('slider_id', '=', $slider_id)->first();
    }
    
  
    public static function editSlider($data,$slider_id)
    {
        return DB::table('slider')->where('slider_id',$slider_id)->update($data);
    }

    public static function deleteSlider($slider_id)
    {
        $oldPhoto =  DB::table('slider')->select('slider_photo')->where('slider_id',$slider_id)->pluck('slider_photo')->first();
        DB::table('slider')->where('slider_id', '=', $slider_id)->delete();
        return $oldPhoto;
    }

    public static function getSliderPhoto($slider_id)
    {
        return DB::table('slider')->where('slider_id', '=', $slider_id)->delete(); 
    }
    public static function SliderCount()
    {
        return DB::table('slider')->count('slider_id');
    }

}
