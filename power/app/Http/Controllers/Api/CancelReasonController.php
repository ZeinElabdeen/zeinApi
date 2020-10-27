<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdsCollection;
use App\Http\Resources\CancelReasonsCollection;
use App\Models\CancelReason;
use App\Http\Controllers\Controller;

class CancelReasonController extends Controller
{
    public function userReasons () {
        $data = CancelReason::where('type','1')->get();
        return response()->json(['data' => ['reasons' => new CancelReasonsCollection($data)]]);
    }

    public function driverReasons () {
        $data = CancelReason::where('type','2')->get();
        return response()->json(['data' => ['reasons' => new CancelReasonsCollection($data)]]);
    }
}
