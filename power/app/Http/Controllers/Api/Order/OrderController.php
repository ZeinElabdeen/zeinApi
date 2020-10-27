<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\MessageController;
use App\Http\Resources\OrdersCollection;
use App\Http\Resources\DriverResource;
use App\Http\Controllers\ResponseController;
use App\Models\DeliverRequest;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Room;
use App\Models\OrderCancelReason;
use App\Models\OrderNotification;
use Validator;

class OrderController extends ResponseController
{
  private $_token,$_body = 'لديك أشعار جديد ';



    public function select_driver () {

      $this->validate(request(),
          [
              'id' => 'required|integer|exists:orders,id,status,0,user_id,'.auth('api')->id(),
          ]);

          //
          $requestdata = DeliverRequest::where('order_id',request()->id)->orderBy('distanc_to_start', 'ASC')->first();

          if(empty($requestdata))
          {
            Driver::where('trip_id',request()->id)->where('has_trip','3')->update(array('has_trip' => '0', 'trip_id' => ''));
            return $this->apiResponse(['message' => trans('response.nooffers')],200);
          }

        //  $order = Order::findOrFail(request()->id);
          $requestdata->order->driver_id = $requestdata->driver_id;
          $requestdata->order->status = '1';
          $save = $requestdata->order->save();

          if (!$save) {
              return $this->apiResponse(['message' => trans('response.failed')],444);
          }

          $requestdata->driver->trip_id = request()->id ;
          $requestdata->driver->has_trip ='1';
          $save = $requestdata->driver->save();

          if (!$save) {
              return $this->apiResponse(['message' => trans('response.failed')],444);
          }

        //delete all  request and release $drivers
          $data = DeliverRequest::where('order_id',request()->id)->pluck('id');
          DeliverRequest::destroy($data);

          Driver::where('trip_id',request()->id)->whereIn('has_trip',['2','3'])->update(array('has_trip' => '0', 'trip_id' => ''));

        // send notifications to driver and user
          $driver_fcm_token = $requestdata->driver->fcm_token ;
          $user_token = $this->user->fcm_token ;
          $sel_lang = 'name_'.\App::getLocale();
          $status_data = \DB::table('order_status')->where('value', '=', '1')->first();
        // notfi driver
          OrderNotification::send($this->user->id,$requestdata->driver->id,'1',request()->id,$this->user->username." ".$status_data->name_ar,$this->user->username." ".$status_data->name_en);
          $this->_token = $driver_fcm_token;
          $content = $this->user->username .' : '. $status_data->$sel_lang;
          $this->sendFcm($this->_token,$this->_body,$content,$this->user,request()->id,'1','1');
        // notfi user
          OrderNotification::send($this->user->id,$requestdata->driver->id,'0',request()->id,$this->user->username." ".$status_data->name_ar,$this->user->username." ".$status_data->name_en);
          $this->_token = $user_token;
          $content = $requestdata->driver->username .' : '. $status_data->$sel_lang;
          $this->sendFcm($this->_token,$this->_body,$content,$requestdata->driver,request()->id,'0','1');

          // create new message room
          $room = new MessageController();
          $room->createRoom($requestdata->driver->id,request()->id);


          return $this->apiResponse(['message' => trans('collection.order.confirm_driver'),'driver' => array_except(new DriverResource($requestdata->driver), [ 'wallet']) ],200);

    }

    public function driverController () {
        $this->validate(request(),
            [
                'status' => 'required|integer|in:4,3,2',
                'reason' => 'required_if:status,==,4|nullable|integer|exists:cancel_reasons,id,type,2',
                'trip_distance' => 'required_if:status,==,3|nullable|numeric',
                'id' => 'required|integer|exists:orders,id,driver_id,'.auth('driver')->id(),
            ]);
        $order = Order::findOrFail(request()->id);

        if( $order->status == request()->status )
        {
          return $this->apiResponse(['message' => trans('response.already_sent')],200);
        }
        $order->status = request()->status;
      //  (request()->status == 4) ? $order->driver_id = null:false ;
        if(request()->status == 3 )
        {
          $km_price = Setting::where('key','km_price')->first()->value_en;
          $order->distance = request()->trip_distance;
          $order->cost = request()->trip_distance * $km_price ;
          $order->finshed_at =  \Carbon\Carbon::now();
        }
        if(request()->status == 2 )
        {
          $order->start_at =  \Carbon\Carbon::now();
        }
        $save = $order->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        // store cancel reason if canceled
        if (request()->status == 4) {
            OrderCancelReason::create([
                'order_id' => request()->id,
                'reason_id' => request()->reason,
            ]);
        }

       if (request()->status == 4 || request()->status == 5) {

        //close chat of this order if trip finshed or canceled
        $chat_room = Room::where('order_id',request()->id)->where('driver_id', $order->driver_id)->first();
        $chat_room->is_closed = '1';
        $chat_room->save();

      }
       $status_data = \DB::table('order_status')->where('value', '=', request()->status)->first();
       $username = $order->driver->username;
       OrderNotification::send($order->user_id,$order->driver_id,'0',$order->id,$username." ".$status_data->name_ar,$username." ".$status_data->name_en);
        $sel_lang = 'name_'.\App::getLocale();
        $this->_token = $order->user->fcm_token;
        $content = $username .' : '. $status_data->$sel_lang;
        $this->sendFcm($this->_token,$this->_body,$content,$order->driver,$order->id,'0','1');
        if(request()->status == 3 )
        {
          $rate_percent = Setting::where('key','rate_percent')->first()->value_en;

          $res_data['total_cost'] = $order->cost;

          if($order->coupon_value > 0 && $order->coupon_value != NULL )
          {
            $res_data['coupon_value'] = $order->coupon_value ."%";
            $res_data['cost_after_discount'] = $order->cost - ($order->cost * ($order->coupon_value /100 ));
            $res_data['app_mony'] = $res_data['cost_after_discount'] * ($rate_percent /100 );
            $res_data['driver_mony'] = $res_data['cost_after_discount'] - $res_data['app_mony'];

          }else{
            $res_data['app_mony'] = $order->cost * ($rate_percent /100 );
            $res_data['driver_mony'] = $order->cost - $res_data['app_mony'];
          }

          $newwallet = $order->driver->wallet - $res_data['app_mony'];
          $order->driver->update(['wallet' =>$newwallet ]);

          return $this->apiResponse(['message' => trans('collection.order.change_status'),'data' =>$res_data ],200);
        }else{

          return $this->apiResponse(['message' => trans('collection.order.change_status')],200);
        }
    }

    public function userControl () {
        $this->validate(request(),
            [
                'status' => 'required|integer|in:4',
                'reason' => 'required_if:status,==,4|nullable|integer|exists:cancel_reasons,id,type,1',
                'id' => 'required|integer|exists:orders,id,user_id,'.auth('api')->id(),
            ]);

        $order = Order::findOrFail(request()->id);
        $order->status = request()->status;

        (request()->status == '4')? $order->driver_id = null: false;

        $save = $order->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        // store cancel reason if canceled
        if (request()->status == 4) {
            OrderCancelReason::create([
                'order_id' => request()->id,
                'reason_id' => request()->reason,
            ]);
        }
        return $this->apiResponse(['message' => trans('collection.order.change_status')],200);
    }

    public function ordersList () {
      //  $orders = Order::all();
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
        if( !empty($order->coupon_value) )
        {
          $order->cost = $request->cost - ( ($order->coupon_value * $request->cost )/100 ) ;
        }else{
          $order->cost = $request->cost;
        }
        $order->status = '1';
        $order->driver_id = request()->driver;
        $save = $order->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        // delete all requests
        $data = DeliverRequest::where('order_id',request()->id)->pluck('id');
        DeliverRequest::destroy($data);

        $username = $this->user->username;
        OrderNotification::send($this->user->id,$request->driver_id,'1',$order->id,"قام $username بالموافقة على عرضك ","$username Accepted Your Offer");
        $content = $username .' : '.trans('collection.order.confirm_driver');
        $this->_token =  Driver::findOrFail(request()->driver)->fcm_token;
        $this->sendFcm($this->_token,$this->_body,$content,$this->user,$order->id,'1','1');
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

    private function sendFcm ($token,$body,$message,$sender,$orderId,$type,$contentType) {
            $data['tokens'][] = $token;
            $data['body'] = $body;
            $data['data']['message'] = $message;
            $data['data']['sender_id'] = $sender->id;
            $data['data']['sender_name'] = $sender->username;
            $data['data']['sender_image'] = ($sender->image != null)? config('user_storage').$sender->image :null;
            $data['data']['order_id'] = $orderId;
            $data['data']['type'] = $type;
            $data['data']['content_type'] = $contentType;
            $data['data']['notifcation_type'] = 'actionONorder';
            return $this->send_fcm($data);

    }

}
