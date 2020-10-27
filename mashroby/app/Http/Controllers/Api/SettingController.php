<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Validator;
use App\Http\Resources\SettingResource;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function setting ($key) {
        Validator::make(
            [
                'key'=> $key
            ],
            [
                'key' => 'required|string|in:terms_and_conditions,about_us'
            ]
        )->validate();

        $lang = (request()->header('lang') == 'ar')? 'ar' : 'en';
        if($key == 'terms_and_conditions' || $key == 'about_us')
        {
          $key = $key.'_'.$lang;
        }
        $data = Setting::where('key',$key)->where('lang',$lang)->first();
        return response()->json(['data' => new SettingResource($data)]);
    }
}
