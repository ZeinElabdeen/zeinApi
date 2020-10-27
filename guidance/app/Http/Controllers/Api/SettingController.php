<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Http\Resources\SettingResource;
use App\Http\Controllers\Controller;
use function Sodium\add;

class SettingController extends Controller
{

    public function about () {
        if(request()->header('lang') == 'ar'){
            $value = 'value_ar';
        }else{
            $value = 'value_en';
        }
        $data = Setting::where('key','about_us')->get();

        return response()->json(['data' => new SettingResource($data)]);
    }

    public function terms () {

        if(request()->header('lang') == 'ar'){
            $value = 'value_ar';
        }else{
            $value = 'value_en';
        }
        $data = Setting::where('key','terms')->get();

        return response()->json(['data' => new SettingResource($data)]);
    }

    public function contacts () {
        if(request()->header('lang') == 'ar'){
            $value = 'value_ar';
        }else{
            $value = 'value_en';
        }
        $data = Setting::where('setting','contact')->get();

        $col = collect();
        foreach ($data as $datum) {
            $col = $col->put($datum['key'],$datum[$value]);
        }

        return response()->json(['data' => $col]);
    }
}
