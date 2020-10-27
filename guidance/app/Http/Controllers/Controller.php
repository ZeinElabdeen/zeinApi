<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $user;
    public function __construct($guard = 'user')
    {
        $this->user = auth($guard)->user();
        if(request()->header('lang') == 'ar'){
            app()->setLocale('ar');
        }else{
            app()->setLocale('en');
        }
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_fcm(array $data)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $key = 'key= AAAATYDmLek:APA91bGTwjsUEe1HlaQTGoGOr9-nzYF21SehQkECP_auuqKQ6cVmMYM-_VpFqI1ADOd83mfeudxzB4GppvbW3_CstGHnz_1myn4R_zrLC6mjCJFrg5QRhFoXCZQGnJPUsc-NS_j7UJC9';
        $fields = [
            'registration_ids' => $data['tokens'],

            'notification' => [
                "body" => $data['body'],
                'title' => "guidance",
                'vibrate' => 1,
                'sound' => 1,
                "color" => "#2bc0d1"
            ],

            'data' => [
                'notifcation_type'   => $data['data']['notifcation_type'],
                'content_type'   => $data['data']['content_type'],
                'type'   => $data['data']['type'],
                'message'   => $data['data']['message'],
                'sender_id'   => $data['data']['sender_id'],
                'order_id' => $data['data']['order_id'],
            ]
        ];

        if(isset( $data['data']['sender_name'] ))
        {
          $fields['data']['sender_name']  =  $data['data']['sender_name'];
          $fields['data']['sender_image'] =  $data['data']['sender_image'] ;
          $fields['data']['created_at'] =  $data['data']['created_at']->format('d/m/Y h:i A') ;
        }

        if(isset( $data['data']['is_rate'] ))
        {
          $fields['data']['is_rate']  =  $data['data']['is_rate'];
        }
        //dd($fields);
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
