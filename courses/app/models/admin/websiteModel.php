<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class websiteModel extends Model
{
    public static function getAd()
    {
        return DB::table('ads_app')->select('*')->where('ads_id',1)->first();
    }
    public static function editAdv($data)
    {
        return DB::table('ads_app')->where('ads_id',1)->update($data);
    }
    public static function getAppPhoto()
    {
        return DB::table('ads_app')->select('ads_cover_photo')->where('ads_id',1)->pluck('ads_cover_photo')->first();
    }

    public static function getInfo()
    {
        return DB::table('website_info')->select('*')->where('info_id',1)->first();
    }

    public static function getInfoLogo()
    {
    return DB::table('website_info')->select('logo')->where('info_id',1)->pluck('logo')->first();
    }

    public static function getInfoLogo2()
    {
    return DB::table('website_info')->select('logo2')->where('info_id',1)->pluck('logo2')->first();
    }

    public static function editInfo($data)
    {
        return DB::table('website_info')->where('info_id',1)->update($data);
    }

    public static function getSocial()
    {
        return DB::table('social_media')->select('*')->get();
    }

    public static function editSocial($data,$social_id)
    {
        return DB::table('social_media')->where('social_id',$social_id)->update($data);
    }

    public static function getAllResets()
    {
        return DB::table('admin_resets_st')->select('*')->get();
    }

    
    
    public static function deleteReset($reset_id)
    {
        return DB::table('pass_resets')->where('reset_id', '=', $reset_id)->delete();
    }
   
    public static function getAllPages()
    {
        return DB::table('pages')->select('*')->get();
    }

    public static function getPage($page_id)
    {
        return DB::table('pages')->select('*')->where('page_id',$page_id)->first();
    }

    public static function editPages($data,$page_id)
    {
        return DB::table('pages')->where('page_id',$page_id)->update($data);
    }

    public static function getPagePhoto($page_id)
    {
        return DB::table('pages')->select('page_photo')->where('page_id',$page_id)->pluck('page_photo')->first();
    }

    public static function getAllMessages()
    {
        return DB::table('admin_contact_st')->select('*')->where('message_reply',null)->get();
    }

    public static function getAllSentMessages()
    {
        return DB::table('admin_contact_st')->select('*')->where('message_reply','<>',null)->get();
    }

    public static function updateReply($data)
    {
        return DB::table('contact_us')->where('message_id',$data['message_id'])->update($data);
    }

    public static function insertMsg($data)
    {
        return DB::table('messages')->insert($data);
    }

    public static function getUnReadMsg()
    {
        return DB::table('admin_msg_noti')->select('*')->orderByDesc('sent_at')->limit(5)->get();
    }

    public static function countUnReadMsg()
    {
        return DB::table('admin_msg_noti')->select('*')->where('read_message',0)->count();
    }

    public static function markAll()
    {
        return DB::table('contact_us_noti')->update(['read_message'=>1]);
    }

    public static function markMessage($message_id)
    {
        return DB::table('contact_us_noti')->where('message_id',$message_id)->update(['read_message'=>1]);
    }
    

    public static function deleteMsg($message_id)
    {
         DB::table('contact_us')->where('message_id', '=', $message_id)->delete();
         return DB::table('contact_us_noti')->where('message_id', '=', $message_id)->delete();

    }

    public static function getAdminNoti()
    {
        return DB::table('admin_reservation_noti')->select('*')->orderByDesc('reserved_at')->limit(5)->get();
    }

    public static function countAdminNoti()
    {
        return DB::table('admin_reservation_noti')->select('*')->where('read_at',0)->count();
    }
    
    public static function markAllNoti()
    {
        return DB::table('reservation_admin_noti')->update(['read_at'=>1]);
    }
    
    


    

    
    

   
}
