<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;

class UpdateImage extends ResponseController
{
    public function index () {
        $this->validate(request(), [
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = auth('api')->user();
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
        return $this->apiResponse(['message' => trans('user.profile.image_updated')],200);
    }
}
