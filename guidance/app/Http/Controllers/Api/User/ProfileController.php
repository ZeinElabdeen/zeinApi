<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\UserResource;
use Validator;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Controller;

class ProfileController extends ResponseController
{
    public function get () {
        $data = auth('user')->user();
        return response()->json(['data' => new UserResource($data)]);
    }

    public function post () {
        $this->validate(request(), [
            'username' => 'nullable|string|min:3|max:191',
            'email' => 'nullable|email|max:191',
            'phone'    => 'nullable|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:users,phone,'.auth('user')->id(),
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = auth('user')->user();

        if (request()->hasFile('image')){
            $this->updateImage();
        }
        $inputs = [
            'username' => request()->username == null ? $user->username : request()->username,
            'email'   => request()->email == null ? $user->email : request()->email,
            'phone'   => request()->phone == null ? $user->phone : request()->phone,

        ];
        if ($user->update($inputs)){
            return $this->apiResponse(['message' => trans('response.updated')],200);
        }
        return $this->apiResponse(['message' => trans('response.failed')],444);

    }

    public function updateImage () {
        $user = auth('user')->user();
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/user'),$imageName);
        if (!$imageMove) {
            return $this->apiResponse(['message' => trans('response.failed_image')],444);
        }
        if ($user->image != null && file_exists(public_path('uploads/user/'.$user->image))) {
            unlink(public_path('uploads/user/'.$user->image));
        }
        $user->image = $imageName;
        $user->save();
        return true;
    }
}
