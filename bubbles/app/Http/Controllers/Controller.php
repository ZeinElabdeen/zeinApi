<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public function __construct()
    {
        if(request()->header('lang') == 'ar'){
            app()->setLocale('ar');
        }else{
            app()->setLocale('en');
        }
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_notification(array $tokens)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $key = 'key=AAAAzAtvK44:APA91bFFWrG0ZsGsdFflZOrP894fmh29Sm2Osq8E-FY8IYrrCw1XM60gN5usaFUJ1TVdtRPfXYE6LyyPEyn3bM80__2toihjrh_oabBsSpKYibALjeGlF2PIwnTIgDLx3ZcUBHwxqkNC';

        $fields = [
            'registration_ids' => $tokens,

            'notification' => [
                "body" => 'message',
                'title' => "test",
                'vibrate' => 1,
                'sound' => 1,
            ],

//            'data' => [
//                'type'   => $data['type'],
//                //'id'     => $data['id'],
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

        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $response;

    }

    public function send ($tokens,$message) {
        $recipients = $tokens;
        return fcm()
            ->to($recipients) // $recipients must an array
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'body' => $message,
            ])
            ->send();
    }
}

