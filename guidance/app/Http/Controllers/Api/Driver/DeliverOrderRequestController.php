<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Models\DeliverRequest;
use App\Models\OrderNotification;
use App\Models\User;
use App\Models\Setting;
use Validator;
use App\Http\Controllers\Controller;

class DeliverOrderRequestController extends ResponseController
{
    private $_token,$_body = 'لديك أشعار جديد ';
    public function __construct($guard = 'driver')
    {
        parent::__construct($guard);


    }

    public function  makeRequest () {

        $this->validate(request(),[
            'id' => 'required|integer|exists:orders,id,status,0',
            'cost' => 'required|integer|min:1',
            'lat' => 'required|string',
            'lng' => 'required|string',
        ]);

        $checkRequestExist = DeliverRequest::where('driver_id',auth('driver')->id())
            ->where('order_id',request()->id)->first();
        if ($checkRequestExist) {
            return $this->apiResponse(['message' => trans('collection.order.exists')],444);
        }
        $percentage = Setting::find(6)->value_en ;
        $percentage_val = (request()->cost * $percentage )/ 100 ;

        if($this->user->wallet < $percentage_val )
        {
          return $this->apiResponse(['message' => trans('response.not_enough_money')],444);
        }

        $create = DeliverRequest::create([
            'order_id' => request()->id,
            'driver_id' => auth('driver')->id(),
            'cost' => request()->cost,
            'lat' => request()->lat,
            'lng' => request()->lng,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
         $newwallet = $this->user->wallet - $percentage_val ;
         $this->user->update(['wallet' =>$newwallet ]);
        $username = $this->user->username;
        OrderNotification::send($create->order->user_id,$this->user->id,'0',request()->id,"قام $username بتقديم عرض توصيل ","$username Offers To Perform Your Order");

        $content = $username .' : '.trans('collection.order.make_request');
        $this->_token =  User::findOrFail($create->order->user_id)->fcm_token;

        $this->sendFcm($this->_token,$this->_body,$content,auth('driver')->id(),request()->id,'4','1');
        return $this->apiResponse(['message' => trans('collection.order.make_request')],200);
    }

    public function deleteRequest () {
        Validator::make(request()->all(),
            [
                'id'=> 'required|integer|exists:deliver_requests,id',

            ])->validate();
        $req_cost = DeliverRequest::where('id',request()->id)->first()->cost;

        $percentage = Setting::find(6)->value_en ;
        $percentage_val = ($req_cost * $percentage )/ 100 ;
        $newwallet = $this->user->wallet + $percentage_val;
        $this->user->update(['wallet' =>$newwallet ]);

        DeliverRequest::destroy(request()->id);
        return response()->json(['message' => trans('response.deleted')]);
    }

    private function sendFcm ($token,$body,$message,$senderId,$orderId,$type,$contentType) {
            $data['tokens'][] = $token;
            $data['body'] = $body;
            $data['data']['message'] = $message;
            $data['data']['sender_id'] = $senderId;
            $data['data']['order_id'] = $orderId;
            $data['data']['type'] = $type;
            $data['data']['content_type'] = $contentType;
            $data['data']['notifcation_type'] = 'order';
            return $this->send_fcm($data);

    }

}
