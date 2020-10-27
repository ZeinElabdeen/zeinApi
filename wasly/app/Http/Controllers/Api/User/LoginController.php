<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\User;

class LoginController extends ResponseController
{
    public function login()
    {

        $this->validate(request(),[
            'phone'    => 'required|numeric',
            'password' => 'required|string|min:8|max:191',
        ]);

        $user = User::where('phone',request()->phone)->first();
        if (!$user) {
            return response()->json(['message' => trans('login.unauthorized')], 401);
        }
        if ($user->is_verified != '1') {
            $response['message']   = trans('user.login.not_verified');
            $response['is_verified'] = 0;
            return $this->apiResponse(['data' => $response],200);
        }
        if ($user->status != '1') {
//            $message['message'] = trans('login.suspended');
            return $this->apiResponse(['message' => trans('login.suspended')],444);
        }
        $credentials = request(['phone', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => trans('login.unauthorized')], 401);
        }
        $id = auth('api')->id();

        $data['id'] = $id;
        $data['is_verified'] = 1;
        $data['token'] = 'Bearer '.$token;
        return response()->json(['data' => $data]);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => trans('login.logout')]);
    }


}
