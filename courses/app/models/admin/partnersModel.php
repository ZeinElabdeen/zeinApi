<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class partnersModel extends Model
{
    public static function getAllPartners () 
    {
        return DB::table('partners')->select('*')->get();
    }

    
   public static function deletePartner($partner_id)
   {
     $photoName =  DB::table('partners')->select('partner_photo')->where('partner_id',$partner_id)->pluck('partner_photo')->first();
     DB::table('partners')->where('partner_id', '=', $partner_id)->delete();
     return $photoName;
    
  }

  public static function getPartner($partner_id)
  {
    return DB::table('partners')->select('*')->where('partner_id',$partner_id)->first();
  }

  public static function insertPartner($data)
  {
    return DB::table('partners')->insert($data);

  }
  

  public static function editPartner($partner_id,$data)
  {
      return DB::table('partners')->where('partner_id',$partner_id)->update($data);
  }

  public static function getOldPhoto($partner_id)
  {
        return  DB::table('partners')->select('partner_photo')->where('partner_id',$partner_id)->pluck('partner_photo')->first();
  }

}
