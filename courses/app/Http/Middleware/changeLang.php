<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\URL;

use Closure;

class changeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // $lang = $request->only('language');
        // $redirect = $request->header('referer');
        
        // $http =  (explode("/",$redirect));
        // $redirectAfterLang = '';
        // $i = 1;
        // foreach ($http as $key => $value) {
        //     if($i == 5){
        //         $redirectAfterLang .= $lang['language'] .'/';
        //     }else{
        //         $redirectAfterLang .= $value .'/';

        //     }
        //     $i++;
        // }

        // return redirect($redirectAfterLang);
        // dd(redirect($redirectAfterLang));
        // dd($redirect);
        // dd(URL::to('/'));
        // return $next($request);
    }
}
