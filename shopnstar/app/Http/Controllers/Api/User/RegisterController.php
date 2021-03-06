<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ResponseController
{
    public function register(Request $request)
    {
        // input validation

        $this->validate(request(), [
            'username' => 'required|string|min:3|max:255',
            'phone'    => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/','unique:users,phone','unique:vendors,phone'],
            'email'    => 'required|email|unique:users,email|max:255',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        // send verification with token
        $rand = User::randToken();
        // upload image

        $create = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'fcm_token' => $request->fcm_token,
            'verified' => $rand,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('user.register.success') ,'code'=> $rand],200);

    }
}
