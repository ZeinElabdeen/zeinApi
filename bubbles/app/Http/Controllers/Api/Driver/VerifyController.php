<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Models\Driver;

class VerifyController extends ResponseController
{
    public function verify () {
        $this->validate(request(),[
            'code' => 'required',
        ]);
        $user = Driver::where('verified',request()->code)->first();
        if (!$user) {
            return $this->apiResponse(['message' => trans('user.verification.not_valid')],444);
        }
        $user->verified = '1';
        $user->save();
        $token = auth('driver')->login($user,true);
        $id = auth('driver')->id();
        $response['id'] = $id;
        $response['is_verified'] = '1';
        $response['token'] = 'Bearer '.$token;
        return $this->apiResponse(['data' => $response],200);
    }

    public function resend () {
        $this->validate(request(),['phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|exists:drivers,phone|max:191',]);
        $user = Driver::where('phone',request()->phone)->first();
        $rand = Driver::randToken();
        $user->verified = $rand;
        $user->save();
        $send_sms = $this->send_code(request()->phone,$rand);
        return $this->apiResponse(['message' => trans('user.verification.success'),'data'=> ['code' => trans('response.check_verfication_code')]],200);
    }

    private function send_code($phone,$rand)
    {
        $username = '966569532966';
        $password = 'A1234567890a';
        $sender = 'BUBBLES';
        $numbers = $phone;
        $message = $rand;
        $api_url = 'https://www.hisms.ws/api.php?send_sms&username='.$username.'&password='.$password.'&numbers='.$phone.'&sender='.$sender.'&message='.$message;
          $ch = curl_init($api_url);
          curl_setopt($ch, CURLOPT_TIMEOUT, 5);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $data = curl_exec($ch);
          curl_close($ch);
          return $data;
    }


}
