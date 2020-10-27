<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\APIS\authApiModel;
use App\models\user\staticPageModel;
use App\models\admin\websiteModel;
use Exeption;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function detectLang($request)
    {
        $header = $request->header('lang');
        $lang=''; //default language
        if($header == 'ar'){
            $lang='_ar'; //arabic language as DB coloum name
        }elseif($header == 'en'){
            $lang=''; //english language as DB coloum name
        }
        
        return $lang;
    }
    public function changeLang(Request $request)
    {
        // return $request->all();
        if($request->language == 'ar'){
            Session()->put('userLang','_ar');
        }else{
            Session()->put('userLang','');
        }
        return redirect()->back();
    }

    public function getUserId($access_token)
    {
        $STID = authApiModel::STID($access_token);
        return $STID;
    }

    public function detectUserLang()
    {
        $lang = '_ar';
        if(Session()->has('userLang')){
            $lang = Session()->get('userLang');
        }
        return $lang;
    }

    public static function partners($i)
    {
        // $i = 0 , 1 ,2
        static $limit = 0;
        if($i != 0){
            $limit+=4;
        }
        $partner = staticPageModel::partners($limit);
        return view('user.ar.layouts.lay',[
            'partner'=> $partner,
            
        ]);
 
    }

    public static function getPartnerCount()
    {
        $countPartners = staticPageModel::countPart();
        $iterationsOfParent = ceil($countPartners/4);
        return view('user.ar.layouts.lay',[
            'countPartners'=>$countPartners,
            'iterationsOfParent'=>$iterationsOfParent,
        ]);
    }

    public static function socialMedia()
    {
        $lang = '_ar';
        if(Session()->has('userLang')){
            $lang = Session()->get('userLang');
        }
        $social = staticPageModel::social();
        // about us in lay
        $about = staticPageModel::getaboutUs();
        $about->title = $about->{'title'.$lang};
        $about->details = $about->{'details'.$lang};
        // website information in footer and header

        $information = staticPageModel::getInformation();
        $information->info_mail = $information->info_mail;
        $information->info_phone = $information->info_phone;
        $information->info_city = $information->{'info_city'.$lang};
        $information->info_country = $information->{'info_country'.$lang};
        
        if($lang == '_ar'){
                return view('user.ar.layouts.lay',[
                    'social'=> $social,
                    'about'=>$about,
                    'info'=>$information,
                ]);
            }else{
                return view('user.en.layouts.lay',[
                    'social'=> $social,
                    'about'=>$about,
                    'info'=>$information,
                ]);
            }
        
    }
    public static function getUnReadMessages()
    {
        $msgCount = websiteModel::countUnReadMsg();
        $messages = websiteModel::getUnReadMsg();
        return view('admin.layouts.nav',[
            'messages'=> $messages,
            'msgCount'=>$msgCount,
        ]);
    }

    public static function markAllAsRead()
    {
        $mark =  websiteModel::markAll();
         return redirect()->back();
    }

    public static function getAdminNoti()
    {
        $reservationCount = websiteModel::countAdminNoti();
        $reservations = websiteModel::getAdminNoti();
        return view('admin.layouts.nav',[
            'reservationCount'=> $reservationCount,
            'reservations'=>$reservations,
        ]);
    }

    public static function markAllAsReadNoti()
    {
        $mark =  websiteModel::markAllNoti();
         return redirect()->back();
    }


  
   

}
