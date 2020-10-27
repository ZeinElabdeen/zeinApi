<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Setting;

class ContactController extends ResponseController
{
    public function index()
    {
        $data = Setting::where('setting','contact')->get();
        $col = collect();
        foreach ($data as $datum) {
            $col = $col->put($datum['key'],$datum['value']);
        }

        return response()->json(['data' => $col]);
    }

}
