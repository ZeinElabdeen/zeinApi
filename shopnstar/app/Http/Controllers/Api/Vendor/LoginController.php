<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Vendor;

class LoginController extends ResponseController
{
    public function login()
    {
        $this->validate(request(),[
            'phone'    => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
            'password' => 'required|string|min:8|max:191',
        ]);

        $user = Vendor::where('phone',request()->phone)->first();
        if (!$user) {
            return $this->apiResponse(['message' => trans('user.login.unauthorized')], 401);
        }
        if ($user->verified != '1') {
            $response['message']   = trans('user.login.not_verified');
            $response['is_verified'] = 0;
            return $this->apiResponse(['data' => $response],200);
        }
        if ($user->status != '1') {
//            $message['message'] = trans('login.login.suspended');
            return $this->apiResponse(['message' => trans('user.login.suspended')],444);
        }
        $credentials = request(['phone', 'password']);

        if (! $token = auth('vendor')->attempt($credentials)) {
            return $this->apiResponse(['message' => trans('user.login.unauthorized')], 401);
        }
        $id = auth('vendor')->id();

        $data['id'] = $id;
        $data['is_verified'] = 1;
        $data['token'] = 'Bearer '.$token;
        return response()->json(['data' => $data]);
    }

    public function logout()
    {
        auth('vendor')->logout();
        return $this->apiResponse(['message' => trans('user.login.logout')],200);
    }


}
