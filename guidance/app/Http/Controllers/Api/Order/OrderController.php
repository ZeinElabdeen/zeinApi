<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\MessageController;
use App\Http\Resources\OrdersCollection;
use App\Http\Controllers\ResponseController;
use App\Models\DeliverRequest;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Room;
use App\Models\OrderCancelReason;
use App\Models\OrderNotification;
use App\Models\Setting;
use Validator;

class OrderController extends ResponseController
{
  private $_token,$_body = 'لديك أشعار جديد ';

    public function driverController () {
        $this->validate(request(),
            [
                'status' => 'required|integer|in:4,3,2',
                'reason' => 'required_if:status,==,4|nullable|integer|exists:cancel_reasons,id,type,2',
                'id' => 'required|integer|exists:orders,id,driver_id,'.auth('driver')->id(),
            ]);
        $order = Order::findOrFail(request()->id);

        $driver_id = $order->driver_id;
        $username = $order->driver->username;

        $order->status = request()->status;

        // store cancel reason if canceled
        if (request()->status == 4) {

            OrderCancelReason::create([
                'order_id' => request()->id,
                'reason_id' => request()->reason,
            ]);


            $percentage = Setting::find(6)->value_en ;
            $percentage_val = ( $order->cost  * $percentage )/ 100 ;
            $newwallet = $order->driver->wallet + $percentage_val;
            $order->driver->update(['wallet' =>$newwallet ]);
        }

      //  $driver_data = $order->driver;

        (request()->status == 4) ? $order->driver_id = null:false ;

        $save = $order->save();

        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }


       if (request()->status == 4 || request()->status == 3) {

        //close chat of this order if trip finshed or canceled
        $chat_room = Room::where('order_id',request()->id)->where('driver_id', $driver_id)->first();
        $chat_room->is_closed = '1';
        $chat_room->save();

       }

       OrderNotification::send($order->user_id,$driver_id,'0',$order->id," $username تم تغيير حالة الطلب","$username Order Status Has Been Changed");

        $this->_token = $order->user->fcm_token;
        $content = $username .' : '. trans('collection.order.change_status');
        $this->sendFcm($this->_token,$this->_body,$content,$driver_id,$order->id,'4','1');
        return $this->apiResponse(['message' => trans('collection.order.change_status')],200);
    }

    public function userControl () {
        $this->validate(request(),
            [
                'status' => 'required|integer|in:4,3',
                'reason' => 'required_if:status,==,4|nullable|integer|exists:cancel_reasons,id,type,1',
                'id' => 'required|integer|exists:orders,id,user_id,'.auth('api')->id(),
            ]);

        $order = Order::findOrFail(request()->id);
        $order->status = request()->status;
        $driver_id = $order->driver_id;
        $this->_token = $order->driver->fcm_token;
      //  $username = $order->driver->username;
        $username = $order->user->username;

        // store cancel reason if canceled
        if (request()->status == 4) {

            OrderCancelReason::create([
                'order_id' => request()->id,
                'reason_id' => request()->reason,
            ]);

            $percentage = Setting::find(6)->value_en ;
            $percentage_val = ( $order->cost  * $percentage )/ 100 ;
            $newwallet = $order->driver->wallet + $percentage_val;
            $order->driver->update(['wallet' =>$newwallet ]);

        }

        (request()->status == '4')? $order->driver_id = null: false;

        $save = $order->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }

        if (request()->status == 4 || request()->status == 3) {

         //close chat of this order if trip finshed or canceled
         $chat_room = Room::where('order_id',request()->id)->where('driver_id', $driver_id)->first();
         $chat_room->is_closed = '1';
         $chat_room->save();

        }

        OrderNotification::send($order->user_id,$driver_id,'1',$order->id," $username تم تغيير حالة الطلب","$username Order Status Has Been Changed");


         $content = $username .' : '. trans('collection.order.change_status');

         $this->sendFcm($this->_token,$this->_body,$content,$order->user_id,$order->id,'4','1');


        return $this->apiResponse(['message' => trans('collection.order.change_status')],200);
    }

    public function ordersList () {
        $orders = Order::where('status','0')->get();
        return response()->json(['data' => new OrdersCollection($orders)]);
    }

    public function confirmDriver () {
        Validator::make(['id' => request()->id],['id'=> 'required|integer|exists:orders,id,status,0'])->validate();
        Validator::make(['driver' => request()->driver],
            ['driver'=> 'required|integer|exists:drivers,id'])->validate();

        $order = Order::findOrFail(request()->id);
        $request = DeliverRequest::where('order_id',request()->id)
            ->where('driver_id',request()->driver)->first();
        if (!$request) {
            return $this->apiResponse(['message' => trans('collection.order.no_request')],444);
        }
        $order->status = '1';
        $order->cost = $request->cost;
        $order->driver_id = request()->driver;
        $save = $order->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        // delete all requests
        $data = DeliverRequest::where('order_id',request()->id)->pluck('id');
        DeliverRequest::destroy($data);

        // delete all requests notifcation of order
        $data = OrderNotification::where('order_id',request()->id)->where('type','0')->pluck('id');
        OrderNotification::destroy($data);

        $username = $this->user->username;
        OrderNotification::send($this->user->id,$request->driver_id,'1',$order->id,"قام $username بالموافقة على عرضك ","$username Accepted Your Offer");
        $content = $username .' : '.trans('collection.order.confirm_driver');
        $this->_token =  Driver::findOrFail(request()->driver)->fcm_token;
        $this->sendFcm($this->_token,$this->_body,$content,$this->user->id,$order->id,'4','1');
        // create new message room
        $room = new MessageController();
        $room->createRoom($request->driver_id,request()->id);
        return $this->apiResponse(['message' => trans('collection.order.confirm_driver')],200);
    }

    public function delete () {
        $this->validate(request(),
            [
                'id' => 'required|integer|exists:orders,id'
            ]);
        $order = Order::findOrFail(request()->id);
        $delete = $order->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        if (count($order->attaches) > 0) {
            foreach ($order->attaches as $attach) {
                $attach->delete();
            }
        }
        return $this->apiResponse(['message' => trans('response.deleted')],200);
    }

    private function sendFcm ($token,$body,$message,$senderId,$orderId,$type,$contentType) {

            $order_statu = Order::findOrFail($orderId)->status;
            if($order_statu == '3')
            {
              $data['data']['is_rate'] = '1';
            }

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
