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
use App\Http\Resources\ChatMessCollection;
class ChatController extends ResponseController
{
    public function index () {

        if( isset(request()->user_id) )
        {
          $chat_list = Chat::where('user_id', '=',request()->user_id)
          ->join('vendors', 'chat.vendor_id', '=', 'vendors.id')
          ->get(['chat.id AS chat_id','chat.user_id','chat.vendor_id','vendors.name AS receiver_name','vendors.image AS receiver_image','chat.order_id','chat.statue'])->toArray();
        }
        elseif( isset(request()->vendor_id) ){
          $chat_list = Chat::where('vendor_id', '=',request()->vendor_id)
          ->join('users', 'chat.user_id', '=', 'users.id')
          ->get(['chat.id AS chat_id','chat.user_id','users.username AS receiver_name','users.image AS receiver_image','chat.vendor_id','chat.order_id','chat.statue'])->toArray();
        }
        $chat_lists  = array();
        foreach ($chat_list as $row) {

          $last_mess = Chat_mess::where('chat_id', '=',$row['chat_id'])
                                ->orderBy('id','desc')->first();
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
        return $this->apiResponse(['message' => trans('collection.chat.closed')], 200);

    }

    public function creat()
    {

      if(isset(request()->vendor_id))
      {
        $this->validate(request(), [
            'order_id' => 'required|exists:orders,id,user_id,'.auth('api')->user()->id,
            'vendor_id' => 'required|integer',
        ]);
        $user_id = auth('api')->user()->id;
        $vendor_id  = request()->vendor_id;

      }
      elseif (isset(request()->user_id)) {

        $this->validate(request(), [
           'order_id' => 'required|exists:orders,id,vendor_id,'.auth('vendor')->user()->id,
           'user_id' => 'required|integer',
        ]);
        $vendor_id = auth('vendor')->user()->id;
        $user_id =  request()->user_id;
      }


         $check_exist = Chat::where('vendor_id', '=',$vendor_id)
                            ->where('order_id', '=',request()->order_id)
                            ->first();
        if( empty($check_exist) )
        {
          $create = Chat::create([
                              'user_id'=>$user_id,
                              'order_id'=>request()->order_id,
                              'vendor_id'=>$vendor_id,
           ]);

           if (!$create) {
               return $this->apiResponse(['message' => trans('response.failed')],444);
           }
             return $this->apiResponse(['message' => trans('collection.chat.added'),
             'data'=> ['chat_id' => $create->id]
             ],200);

          }
          else{
              return $this->apiResponse(['message' => trans('collection.chat.exists'),
              'data'=> ['chat_id' => $check_exist->id] ]
              ,200);
         }

    }

    public function details()
    {
      $this->validate(request(), [
          'chat_id' => 'required|integer|exists:chat,id',
      ]);

    //  $chat_mess = Chat_mess::orderBy('created_at', 'ASC')->where('chat_id', '=',request()->chat_id)
      ///              ->get(['id','chat_id','sender_type','seen','mesg','type','created_at'])->toArray();
      $chat_mess = Chat_mess::orderBy('created_at', 'ASC')
                            ->where('chat_id', '=',request()->chat_id)
                            ->get();

      if(empty($chat_mess))
      {
        return $this->apiResponse(['data'=> $chat_mess],200);
      }
      else{
      //  return $this->apiResponse(['data'=> $chat_mess],200);
        return $this->apiResponse(['data'=> new ChatMessCollection($chat_mess) ],200);


      }


    }

    public function send_message()
    {

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
      else if(request()->type == '2' )
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
        $create['vendor_id'] = $chat_data->vendor_id ;
        $create['user_id'] = $chat_data->user_id ;
       if(request()->sender_type == '1')
       {
        // $reciver_data = Vendor::find($chat_data->vendor_id)->fcm_token;
         $reciver_data = $chat_data->vendor->fcm_token;
         $create['sender_name'] =$chat_data->user->username ;
         $create['sender_imag'] = ($chat_data->user->image != null)? config('user_storage').$chat_data->user->image :null;
         $this->notifcation(array($reciver_data),$message,$create);
       }else{
         //$reciver_data = User::find($chat_data->user_id)->fcm_token;
         $reciver_data = $chat_data->user->fcm_token;
         $create['sender_name'] =$chat_data->vendor->name ;
         $create['sender_imag'] = ($chat_data->vendor->image != null)? config('vendor_storage').$chat_data->vendor->image :null;
         $this->notifcation(array($reciver_data),$message,$create);
       }

       return $this->apiResponse(['message' => trans('collection.chat.sent')],200);

    }

    private function notifcation($registrationIds,$message,$create)
    {
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAU7ds1P4:APA91bFcpLwkjdbWObe5MX7TdGxU4MM5lUQN1CrW0Wfzv5ODcsc0om1i1xz8NCY7gwrqjieEFOvWCgfqNxuATy6xWWeSCDBSkXtOYhZsOshqzXFvKvT2-ZS2Ksyw6goJlrn3ZaXzUhxr');

        // prep the bundle
        $msg = array
        (
        	'message' 	=> $message,
        	'sender_name' 	=> $create->sender_name,
        	'sender_imag' 	=> $create->sender_imag,
        	'user_id'		  => $create->user_id,
        	'vendor_id'	=> $create->vendor_id,
          'created_at'=> $create->created_at->format('d/m/Y h:i A'),
          'chat_id'   => $create->chat_id,
          'type' => $create->type,
        	'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        	'vibrate'	=> 1,
        	'sound'		=> 1
        );

        $fields = array
                    (
                        'registration_ids' => $registrationIds,
                        'data' => $msg,
                        'priority' => 'high',
                        'notification' => array(
                            'title' => trans('collection.chat.new'),
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
