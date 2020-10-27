<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\ResponseController;
use App\Models\Vendor;

class VerifyController extends ResponseController
{
    public function verify () {
        $this->validate(request(),[
            'code' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
        ]);
        $user = Vendor::where('verified',request()->code)->first();
        if (!$user) {
            return $this->apiResponse(['message' => trans('user.verification.not_valid')],444);
        }
        $user->verified = '1';
        $user->save();
        $token = auth('vendor')->login($user,true);
        $id = auth('vendor')->id();
        $response['id'] = $id;
        $response['is_verified'] = '1';
        $response['token'] = 'Bearer '.$token;
        return $this->apiResponse(['data' => $response],200);
    }

    public function resend () {
        $this->validate(request(),['phone' => 'required|exists:vendors,phone']);
        $user = Vendor::where('phone',request()->phone)->first();
        $rand = Vendor::randToken();
        $user->verified = $rand;
        $user->save();
        return $this->apiResponse(['message' => trans('user.verification.success'),'code' => $rand],200);
    }

}
