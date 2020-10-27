<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;
use App\Models\Social_page;
use App\Models\Seo_settings;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if(request()->header('lang') == 'ar'){
            app()->setLocale('ar');
        }else{
            app()->setLocale('en');
        }
        $status[0] =  __('front.status_0') ;
        $status[1] =  __('front.status_1') ;
        $status[2] =  __('front.status_2') ;
        $status[3] =  __('front.status_3') ;
        $status[4] =  __('front.cancel_order') ;

        View::share('social', Social_page::first());
        View::share('seo', Seo_settings::first());
        View::share('status',$status);


        $this->middleware(function ($request, $next) {
          $cart_size='';
          $favorite_size='';
          $cart =  session()->get('cart');
          $favorite =  session()->get('favorite');
          if(!empty($cart)) {
            $cart_size = sizeof($cart);
          }
          if(!empty($favorite)) {
            $favorite_size = sizeof($favorite);
          }
          View::share('cart_size', $cart_size);
          View::share('favorite_size', $favorite_size);
         return $next($request);
       });

    }


}
