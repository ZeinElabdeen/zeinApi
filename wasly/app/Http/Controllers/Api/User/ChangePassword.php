<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends ResponseController
{
    public function index () {
        $user = auth('api')->user();

        $checkOldPassword = Hash::check(request()->old_password,$user->password);

        if (!$checkOldPassword) {
            return $this->apiResponse(['message' => trans('user.profile.old_password_failed')],444);
        }

        $this->validate(request(), [
            'old_password' => 'required|alphaNum|min:8|max:36',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        $user->password = Hash::make(request()->password);
        $save = $user->save();
        if ($save){
            return $this->apiResponse(['message' => trans('user.profile.password_success')],200);
        }
        return $this->apiResponse(['message' => trans('response.failed')],444);

    }
}
