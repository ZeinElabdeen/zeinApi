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

        $key = 'key= AAAAFpU6nqQ:APA91bH3Mhp-ZJsumvwr7mlGIPaF-iPzZ4T9_bPDPZfeRwH95pOQk9nNg7P3GYIUKl8efw33dlKbBbAoc-FET6rzCTZaUw962q7Z1v5tMXvhaYgHRAKSWjl-5tZI9VYykZ5AeiGOPih1';
        $fields = [
            'registration_ids' => $data['tokens'],

           'notification' => [
                "body" => $data['body'],
                'title' => "shopnstar",
                'vibrate' => 1,
                'sound' => 1,
                "color" => "#322b48"
            ],

            'data' => [
                'type'   => $data['data']['type'],
                'message'   => $data['data']['message'],
                'sender_id'   => $data['data']['sender_id'],
                'receiver_id'   => $data['data']['receiver_id'],
                'chat_id' => $data['data']['chat_id'],
            ]
        ];

        if(isset( $data['data']['sender_name'] ))
        {
          $fields['data']['sender_name']  =  $data['data']['sender_name'];
          $fields['data']['sender_image'] =  $data['data']['sender_image'] ;
        }

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

    public function send_notifcation(array $data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $key = 'key= AAAAU7ds1P4:APA91bFcpLwkjdbWObe5MX7TdGxU4MM5lUQN1CrW0Wfzv5ODcsc0om1i1xz8NCY7gwrqjieEFOvWCgfqNxuATy6xWWeSCDBSkXtOYhZsOshqzXFvKvT2-ZS2Ksyw6goJlrn3ZaXzUhxr';
        $fields = [
            'registration_ids' => $data['tokens'],

           'notification' => [
                "body" => $data['data']['message'],
                'title' => "Shopnstar",
                'vibrate' => 1,
                'sound' => 1,
                "color" => "#322b48"
            ],

            'data' => [
                'type'   => 1,
                'message'   => $data['data']['message'],
                'vendor_id'   => $data['data']['vendor_id'],
                'order_id'   => $data['data']['order_id'],
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
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
