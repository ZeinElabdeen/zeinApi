<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use App\Models\User;

class VerifyController extends ResponseController
{
    public function verify () {
        $this->validate(request(),[
            'code' => 'required|numeric',
        ]);
        $user = User::where('verified',request()->code)->first();
        if (!$user) {
            return $this->apiResponse(['message' => trans('user.verification.not_valid')],444);
        }
        $user->verified = '1';
        $user->save();
        $token = auth('api')->login($user,true);
        $id = auth('api')->id();
        $response['id'] = $id;
        $response['type'] = auth('api')->user()->type;
        $response['is_verified'] = '1';
        $response['token'] = 'Bearer '.$token;
        return $this->apiResponse(['data' => $response],200);
    }

    public function resend () {
        $this->validate(request(),['phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|exists:users,phone|max:191',]);
        $user = User::where('phone',request()->phone)->first();
//        $rand = User::randToken();
//        $checkEmailSend = User::verifyMail($user->username,$user->email,$rand);
//        if ($checkEmailSend == false){
//            return $this->apiResponse(['message'=> trans('user.email_verification.not_sent') ],444);
//        }
        $user->verified = '55555';
        $user->save();
        return $this->apiResponse(['message' => trans('user.verification.success')],200);
    }

}
