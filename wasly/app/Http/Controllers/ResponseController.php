<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function __construct()
    {
        if(request()->header('lang') == 'ar'){
            app()->setLocale('ar');
        }else{
            app()->setLocale('en');
        }
    }

    protected function apiResponse($response,$code)
    {
        return response()->json($response, $code);
    }
}
