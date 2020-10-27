<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use Validator;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Controller;

class ProfileController extends ResponseController
{
    public function get () {
        $data = auth('api')->user();
        return response()->json(['data' => new User($data)]);
    }

    public function post () {
        $this->validate(request(), [
            'first_name' => 'nullable|string|min:3|max:191',
            'last_name' => 'nullable|string|min:3|max:191',
            'phone' => 'nullable|regex:/[0-9]{9}/|starts_with:01|size:11|unique:users,phone,'.auth('api')->id(),
            'city' => 'nullable|integer|exists:cities,id',
            'password' => 'nullable|alphaNum|confirmed|min:8|max:36',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:4000',
        ]);

        $user = auth('api')->user();
        if (request()->hasFile('image')) {
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/user'),$imageName);
            if (!$imageMove) {
                return response()->json(['message' => trans('response.failed')],444);
            }
            if ($user->image != null && file_exists(public_path('uploads/user/'.$user->image))) {
                unlink(public_path('uploads/user/'.$user->image));
            }
            $user->image = $imageName;
            $user->save();
        }

        $inputs = [
            'first_name' => request()->first_name == null ? $user->first_name : request()->first_name,
            'last_name' => request()->last_name == null ? $user->last_name : request()->last_name,
            'phone' => request()->phone == null ? $user->phone : request()->phone,
            'city_id' => request()->city == null ? $user->city_id : request()->city,
            'password' => request()->gender == null ? $user->password : Hash::make(request()->password),
        ];
        if ($user->update($inputs)){
            return response()->json(['message' => trans('response.updated')]);
        }
        return response()->json(['message' => trans('response.failed')],444);

    }

}
