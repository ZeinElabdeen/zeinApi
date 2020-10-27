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
        $user = auth('api')->user();
        $currentWallet = $user->wallet;
        $points = $user->points;
        $pointValue = Setting::setting('point_value');
        $convertedValue = $points * $pointValue;
        $user->points = 0;
        $user->wallet = $currentWallet + $convertedValue;
        $save = $user->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.money.success')],200);
    }
}
