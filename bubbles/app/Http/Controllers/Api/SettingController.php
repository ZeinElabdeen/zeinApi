<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Http\Resources\SettingResource;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index () {

        $data = Setting::all();
        return response()->json(['data' => new SettingResource($data)]);
    }
}
