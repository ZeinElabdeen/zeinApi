<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SettingsCollection;
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

        $data = Setting::where('key',$key)->first();
        return response()->json(['data' => new SettingResource($data)]);
    }

    public function contacts () {
        $data = Setting::where('setting','contacts')->get();
        return response()->json(['data' => new SettingsCollection($data)]);
        }
}
