<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ResponseController;
use App\Models\User;
use App\Models\Driver;
use App\Models\Package;
use App\Models\Chat;
use App\Models\Chat_mess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends ResponseController
{
    public function index () {

        if( isset(request()->user_id) )
        {
          $chat_list = Chat::where('user_id', '=',request()->user_id)
        //  ->join('users', 'chat.user_id', '=', 'users.id')
          ->join('drivers', 'chat.driver_id', '=', 'drivers.id')
          ->get(['chat.id AS chat_id','chat.user_id','chat.driver_id','drivers.username AS receiver_name','drivers.image AS receiver_image','chat.package_id','chat.statue'])->toArray();
        }
        elseif( isset(request()->driver_id) ){
          $chat_list = Chat::where('driver_id', '=',request()->driver_id)
          ->join('users', 'chat.user_id', '=', 'users.id')
        //  ->join('drivers', 'chat.driver_id', '=', 'drivers.id')
          ->get(['chat.id AS chat_id','chat.user_id','users.username AS receiver_name','users.image AS receiver_image','chat.driver_id','chat.package_id','chat.statue'])->toArray();
        }
        $chat_lists  = array();
        foreach ($chat_list as $row) {

          $last_mess = Chat_mess::where('chat_id', '=',$row['chat_id'])
                                ->orderBy('created_at','desc')->first();
           if(!empty($last_mess->mesg)){
                    $row += [ "last_mess" => $last_mess->mesg ];
                    $row += [ "last_mess_type" => $last_mess->type ];
                  } else {
                    $row += [ "last_mess" => '' ];
                    $row += [ "last_mess_type" => 0 ];
                  }
                  $chat_lists[]=$row;
        }
        return response()->json(['data' => $chat_lists ]) ;

    }
    public function chat_closed()
    {
        $this->validate(request(), [
            'chat_id' => 'required|exists:chat,id',
        ]);

        $chat_data = Chat::find(request()->chat_id);
        $chat_data->statue = '1' ;
        $chat_data->save();
        return $this->apiResponse(['message' => trans('response.chat_closed')],200);

    }

    public function creat()
    {
    //  $this->validate(request(), [
          //'package_id' => 'required|exists:packages,id,user_id,'.auth('api')->user()->id,
        //  'driver_id' => 'required|integer',
    //  ]);
    if(isset(request()->driver_id))
    {
      $this->validate(request(), [
          'package_id' => 'required|exists:packages,id,user_id,'.auth('api')->user()->id,
          'driver_id' => 'required|integer',
      ]);
      $user_id = auth('api')->user()->id;
      $driver_id  = request()->driver_id;

    }elseif (isset(request()->user_id)) {

      $this->validate(request(), [
         'package_id' => 'required|exists:packages,id,driver_id,'.auth('driver')->user()->id,
         'user_id' => 'required|integer',
      ]);
      $driver_id = auth('driver')->user()->id;
      $user_id =  request()->user_id;
    }


      $check_exist = Chat::where('driver_id', '=',$driver_id)
          ->where('package_id', '=',request()->package_id)
          ->first();
      if( empty($check_exist) )
      {
        $create = Chat::create([
                            'user_id'=>$user_id,
                            'package_id'=>request()->package_id,
                            'driver_id'=>$driver_id,
         ]);

         if (!$create) {
             return $this->apiResponse(['message' => trans('response.failed')],444);
         }
         return $this->apiResponse(['message' => 'chat added successfully',
         'data'=> ['chat_id' => $create->id]
         ],200);

      }else{
        //return $this->apiResponse(['message' => 'chat already exists','chat_id'=> $check_exist->id],200);
        return $this->apiResponse(['message' => 'chat already exists',
        'data'=> ['chat_id' => $check_exist->id] ]
        ,200);
      }

    }

    public function details()
    {
      $this->validate(request(), [
          'chat_id' => 'required|integer|exists:chat,id',
      ]);

      $chat_mess = Chat_mess::orderBy('created_at', 'ASC')->where('chat_id', '=',request()->chat_id)
                    ->get(['id','chat_id','sender_type','seen','mesg','type','created_at'])->toArray();

      if(empty($chat_mess))
      {
        return $this->apiResponse(['data'=> $chat_mess],200);
      }
      else{
        return $this->apiResponse(['data'=> $chat_mess],200);

      }


    }

    public function send_message()
    {
      //$token = request()->bearerToken();
      $this->validate(request(), [
          'chat_id' => 'required|integer|exists:chat,id',
          'mesg' => 'required',
          'type' => 'required|integer',
          'sender_type' => 'required|integer',
      ]);
      if(request()->type == '1')
      {
        $message = request()->mesg;
      }
      else if(request()->type == '2' || request()->type == '3')
      {
        if (request()->hasFile('mesg')){
            $file = request()->file('mesg');

                $fileName = md5(time()). '.'.$file->getClientOriginalExtension();
                $fileMove = $file->move(public_path('uploads/chat'),$fileName);
                if (!$fileMove) {
                    return $this->apiResponse(['message' => trans('response.failed_image')],444);
                }
             $message = $fileName ;
          }
      }
      $create = Chat_mess::create([
                          'chat_id'=>request()->chat_id,
                          'type'=>request()->type,
                          'mesg'=>$message,
                          'sender_type'=>request()->sender_type,
       ]);

       if (!$create) {
           return $this->apiResponse(['message' => trans('response.failed')],444);
       }
       $chat_data = Chat::find(request()->chat_id);
       if(request()->sender_type == '1')
       {
         $reciver_data = Driver::find($chat_data->driver_id)->registration_id;
         $this->notifcation(array($reciver_data),$message,$create);
       }else{
         $reciver_data = User::find($chat_data->user_id)->registration_id;
         $this->notifcation(array($reciver_data),$message,$create);
       }

       return $this->apiResponse(['message' => 'message sent successfully'],200);

    }

    private function notifcation($registrationIds,$message,$create)
    {
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAvQLYYD0:APA91bHZfD-F17TsloAJz9pV32kLmdg4bXZ_6-EiuRcKgCJruedpeyhaqQ5lPqxFjlHOFFPNGwhAVG6WpD1qv3YvZ5A4NA7vd11riGYfGV8DU97XQ6tOg-CbImFdZQ2VJPfHclsFhQf_');
        //$registrationIds = array($_POST['register_key']);

        // prep the bundle
        $msg = array
        (
        	'message' 	=> $message,
        	'title'		  => trans('response.new_message'),
        	'subtitle'	=> trans('response.new_message'),
          'created_at'=> $create->created_at,
          'chat_id'   => $create->chat_id,
          'mess_type' => $create->type,
          'type'	  => 2,
        	'vibrate'	=> 1,
        	'sound'		=> 1
        );

        $fields = array
                    (
                        'registration_ids' => $registrationIds,
                        'data' => $msg,
                        'priority' => 'high',
                        'notification' => array(
                            'title' => 'New message',
                            'body' => $message
                        )
                    );

        $headers = array
        (
        	'Authorization: key=' . API_ACCESS_KEY,
        	'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
      //  echo $result;

    }

}
