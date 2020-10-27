<?php

namespace App\Http\Controllers\Api\User\User;

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
            'phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:users,phone',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        // send email sms with token
//        $rand = User::randToken();

        // prepare inputs
        $data = User::create([
            'type' => '0',
            'username' => $request->username,
            'phone' => $request->phone,
            'verified' => '55555',
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('user.register.success')],200);

    }
}
