<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use App\Models\User;

class EmailVerifyController extends ResponseController
{
    public function verify () {
        $this->validate(request(),[
            'code' => 'required|numeric',
        ]);
        $user = User::where('is_verified',request()->code)->first();
        if (!$user) {
            return response()->json(['message' => 'not valid code'],444);
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
        $this->validate(request(),['email' => 'required|email|exists:users,email|max:191',]);
        $user = User::where('email',request()->email)->first();
        $rand = User::randToken();
        $checkEmailSend = User::verifyMail($user->username,$user->email,$rand);
        if ($checkEmailSend == false){
            return response()->json(['message'=> 'can\'t send email' ],444);
        }
        $user->email_verified = $rand;
        $user->save();
        return response()->json(['message' => 'verification email was sent']);
    }

}
