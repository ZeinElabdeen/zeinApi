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
            'phone'    => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/','unique:users,phone'],
            'birth_date'    => 'required|date',
      //    'email'    => 'required|email|max:255',
//            'image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        // send verification with token
        $rand = User::randToken();
        // upload image
//        if ($request->hasFile('image')) {
//            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
//            $imageMove = request()->file('image')->move(public_path('uploads/user'),$imageName);
//            if (!$imageMove) {
//                return $this->apiResponse(['message' => trans('response.failed_image')],444);
//            }
//        }

        $create = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'verified' => $rand,
//            'image' => $imageName,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('user.register.success'),'code' => $rand],200);

    }
}
