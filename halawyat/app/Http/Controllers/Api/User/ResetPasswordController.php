<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends ResponseController
{
    public function sendCode () {
        $this->validate(request(),['phone' => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/'],]);

        $token = $this->randToken();
        $user = User::where('phone',request()->phone)->first();
        $user->reset_password_code = 55555;
        $user->code_expiration = date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(5)));
        $user->save();

        return $this->apiResponse(['message'=> trans('user.reset_pwd.code_sent') ],200);


    }

    public function check () {
        $this->validate(request(),['code' => ['required','integer']]);

        $user = User::where('reset_password_code',request()->code)->where('code_expiration','>=',Carbon::now())->first();
        if (!$user) {
            return $this->apiResponse(['message'=> trans('user.reset_pwd.code_expire') ],444);
        }
        return response()->json(['data' => $user]);
    }

    public function resetPassword () {
        $this->validate(request(),
            [
                'phone'    => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|exists:users,phone|max:191',
                'password' => 'required|alphaNum|confirmed|min:8|max:36',
            ]);
        $user = User::where('phone',request()->phone)->first();
        if (!$user) {
            return $this->apiResponse(['message'=> trans('response.no_user') ],444);
        }
        $user->password = Hash::make(request()->password);
        $user->save();
        return $this->apiResponse(['message'=> trans('user.reset_pwd.success') ],200);
    }

    protected function randToken () {
        $token = rand(10000,99999);
        return (User::where('reset_password_code',$token)->first())?$this->randToken():$token;
    }
}
