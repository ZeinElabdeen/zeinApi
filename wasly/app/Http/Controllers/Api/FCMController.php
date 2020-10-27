<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;

class FCMController extends ResponseController
{
    public function submitToken()
    {
        request()->validate([
            'token' => 'required|string',
        ]);

        auth('api')->user()->fcm_token = request()->token;
        $save = auth('api')->user()->save();
        if (!$save) {
            return $this->apiResponse('',500);
        }
        return $this->apiResponse('',200);
    }
// test
    public function sendN ($token = ['cHGujLcs45w:APA91bH7LVtGLszs39C8PFL1qbgF6dCtD38nntFqbInCtjXwRXxvrtdNNHMzC0Rp0DljpZ3Ch7ehlKbMEFrvFtMBo6cbl5GeFyMWXhAsxgqxJ9liNnCCeTcfYeB38Y0xqFo-7fPEY1nA'])
    {
        $data['tokens'] = $token;
        $data['body']= 'test body';
        $data['data']['type']= 'test type';
        $data['data']['message']= 'test message';
//return $data;
        return $this->send_fcm($data);
    }

}
