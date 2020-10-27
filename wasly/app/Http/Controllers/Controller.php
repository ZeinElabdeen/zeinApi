<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_fcm(array $data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $key = 'key= AAAAZ5yRYXQ:APA91bFU2W6jpGBD02STqyE9OS73HWm-YOPPl37t37zTgw25VHa_9tEhA29NWWO9y47IeLjLwbAW16bWYQN4gOrRrIZ5bkW3r_7D3KKJ6eM1JiekWFzC3obnfksvOsIhRKHFYpNNVNn9';
        $fields = [
            'registration_ids' => $data['tokens'],

            'notification' => [
                "body" => $data['body'],
                'title' => "وصلي",
                'vibrate' => 1,
                'sound' => 1,
                "color" => "#2bc0d1"
            ],

//            'data' => [
//                'order_id' => $data['order_id'],
//            ]
        ];
        $fields = json_encode($fields);

        $headers = array(
            "Authorization: $key",
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
