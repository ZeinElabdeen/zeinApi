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
            'username' => 'nullable|string|min:3|max:191',
            'password' => 'nullable|alphaNum|confirmed|min:8|max:36',
        ]);

        $user = auth('api')->user();
        $inputs = [
            'username' => request()->username == null ? $user->username : request()->username,
            'password' => request()->gender == null ? $user->password : Hash::make(request()->password),
        ];
        if ($user->update($inputs)){
            return response()->json(['message' => 'info updated successfully']);
        }
        return response()->json(['message' => 'Oops Something Went Wrong'],444);

    }

    public function updateImage () {
        $this->validate(request(), [
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:4000',

        ]);

        $user = auth('api')->user();
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/user'),$imageName);
        if (!$imageMove) {
            return response()->json(['message' => 'Oops Something Went Wrong Unable To Upload Image'],444);
        }
        if ($user->image != null && file_exists(public_path('uploads/user/'.$user->image))) {
            unlink(public_path('uploads/user/'.$user->image));
        }
        $user->image = $imageName;
        $user->save();
        return response()->json(['message' => 'Photo Updated']);
    }
}
