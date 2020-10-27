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
        $user = User::where('is_verified',request()->code)->first();
        if (!$user) {
            return response()->json(['message' => trans('user.verification.not_valid')],444);
        }
        $user->is_verified = '1';
        $user->save();
        $token = auth('api')->login($user,true);
        $id = auth('api')->id();
        $response['id'] = $id;
        $response['is_verified'] = '1';
        $response['token'] = 'Bearer '.$token;
        return $this->apiResponse(['data' => $response],200);
    }

    public function resend () {
        $this->validate(request(),['phone' => 'required|exists:users,phone|max:191',]);
        $user = User::where('phone',request()->phone)->first();
//        $rand = User::randToken();

        $user->is_verified = '55555';
        $user->save();
        return response()->json(['message' => trans('user.verification.success')]);
    }

}
