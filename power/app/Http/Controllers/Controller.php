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

        $key = 'key= AAAAvQLYYD0:APA91bHZfD-F17TsloAJz9pV32kLmdg4bXZ_6-EiuRcKgCJruedpeyhaqQ5lPqxFjlHOFFPNGwhAVG6WpD1qv3YvZ5A4NA7vd11riGYfGV8DU97XQ6tOg-CbImFdZQ2VJPfHclsFhQf_';
        $fields = [
            'registration_ids' => $data['tokens'],

            'notification' => [
                "body" => $data['body'],
                'title' => "Power",
                'vibrate' => 1,
                'sound' => 1,
                "color" => "#7f00ff"
            ],

            'data' => [
                'notifcation_type'   => $data['data']['notifcation_type'],
                'content_type'   => $data['data']['content_type'], // 1 => text, 2 => image, 3 => voice
                'type'   => $data['data']['type'],    // 0-> for user ,1-> for driver
                'message'   => $data['data']['message'],
                'sender_id'   => $data['data']['sender_id'],
                'sender_name'   => $data['data']['sender_name'],
                'sender_image'   => $data['data']['sender_image'],
                'order_id' => $data['data']['order_id'],
            ]
        ];

      if( $data['data']['notifcation_type'] == 'new_order')
       {
         $fields['data']['start_lat']  =  $data['data']['start_lat'];
         $fields['data']['start_lng']  =  $data['data']['start_lng'];
         $fields['data']['end_lat']    =  $data['data']['end_lat'];
         $fields['data']['end_lng']    =  $data['data']['end_lng'];
       }

      if(isset( $data['data']['created_at'] ))
       {
         $fields['data']['created_at']  =  $data['data']['created_at'];
       }
      if(isset( $data['data']['expir_at'] ))
       {
         $fields['data']['expir_at']  =  $data['data']['expir_at'];
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
