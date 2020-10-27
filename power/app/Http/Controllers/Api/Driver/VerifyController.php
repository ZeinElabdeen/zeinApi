<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Models\Driver;

class VerifyController extends ResponseController
{
    public function verify () {
        $this->validate(request(),[
            'code' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
        ]);
        $user = Driver::where('verified',request()->code)->first();
        if (!$user) {
            return $this->apiResponse(['message' => trans('user.verification.not_valid')],444);
        }
        $user->verified = '1';
        $user->save();
        $token = auth('driver')->login($user,true);
        $id = auth('driver')->id();
        $response['id'] = $id;
        $response['is_verified'] = '1';
        $response['token'] = 'Bearer '.$token;
        return $this->apiResponse(['data' => $response],200);
    }

    public function resend () {
        $this->validate(request(),['phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|exists:drivers,phone',]);
        $user = Driver::where('phone',request()->phone)->first();
        $rand = Driver::randToken();
        $user->verified = $rand;
        $user->save();
        return $this->apiResponse(['message' => trans('user.verification.success'),'code' => $rand],200);
    }

}
