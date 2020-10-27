<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if(request()->header('lang') == 'en'){
            app()->setLocale('en');
        }else{
            app()->setLocale('ar');
        }
    }

    public function send_fcm(array $data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $key = 'key= AAAAFpU6nqQ:APA91bH3Mhp-ZJsumvwr7mlGIPaF-iPzZ4T9_bPDPZfeRwH95pOQk9nNg7P3GYIUKl8efw33dlKbBbAoc-FET6rzCTZaUw962q7Z1v5tMXvhaYgHRAKSWjl-5tZI9VYykZ5AeiGOPih1';
        $fields = [
            'registration_ids' => $data['tokens'],

           'notification' => [
                "body" => $data['body'],
                'title' => "فن المناسبات",
                'vibrate' => 1,
                'sound' => 1,
                "color" => "#2bc0d1"
            ],

            'data' => [
                'type'   => $data['data']['type'],
                'message'   => $data['data']['message'],
                'sender_id'   => $data['data']['sender_id'],
                'receiver_id'   => $data['data']['receiver_id'],
                'room_id' => $data['data']['room_id'],
            ]
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
