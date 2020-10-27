<?php

namespace App\Http\Controllers\Api\User;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Traits\Sms;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // input validation

        $this->validate(request(), [
            'username' => 'required|string|min:3|max:255',
//            'email' => 'required|email|max:255|unique:users,email',
           // 'phone' => 'required|regex:/[0-9]{9}/|unique:users,phone',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        // send sms verification with token
        $rand = User::randToken();
        $checkSendSms = Sms::sendSms('ActivationCode'. $rand,request()->phone);
     
        if ($checkSendSms == false){
           return response()->json(['message'=> 'Can\'t Send Sms Please Contact Owner' ],444);
        }
        // prepare inputs
        $data = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'is_verified' => $rand,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return response()->json(['message' => 'Oops Somthing went wrong'],444);
        }
        return response()->json(['message' => 'account added successfully']);

    }
}
