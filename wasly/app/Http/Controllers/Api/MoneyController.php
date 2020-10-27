<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Setting;

class MoneyController extends ResponseController
{
    public function index () {
        $data['points'] = auth('api')->user()->points;
        $data['wallet'] = auth('api')->user()->wallet;
        $data['tax'] = Setting::setting('tax');
        return response()->json(['data' => $data]);
    }

    public function convertPoints () {
        $currentWallet = auth('api')->user()->wallet;
        $points = auth('api')->user()->points;
        $pointValue = Setting::setting('point_value');
        $convertedValue = $points * $pointValue;
        auth('api')->user()->points = 0;
        auth('api')->user()->wallet = $currentWallet + $convertedValue;
        $save = auth('api')->user()->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.money.success')],200);
    }
}
