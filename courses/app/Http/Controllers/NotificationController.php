<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notify() {

        $rerservation_id = 1;
        $title = 'hello world';
        $msg = 'this is the first notification';
        $access_token = 'zDdqMKSlNyNwUaDA3usqXc4zN6lsPQ3YJOQAQrueADE4DthJOB3GBmIkG1mG';
        parent::notifcation($rerservation_id,$title,$msg,$access_token);
        return 'ok';
     
     }
}
