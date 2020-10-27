<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\ResponseController;
use App\Models\Attach;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\OrderNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;

class StoreOrderController extends ResponseController
{
  private $_token,$_body = 'لديك أشعار جديد ';
    public function index() {


//dd(\request()->all());
        $this->validate(request(),
            [
                'start_lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'start_lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'end_lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'end_lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'coupon_code' => 'nullable|string|exists:coupons,code',
                'distance' => 'required|numeric',
                //'pickup_time' => 'required|date|after:'.Carbon::now(),
              //  'type' => 'required|in:0,1',
                'car_type' => 'required_if:type,==,0|integer',
                'gender' => 'required_if:type,==,0|in:0,1',
              //  'payment_method' => 'required|in:0,1',
              //  'images' => 'required_if:type,==,1|array',
              //  'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
            ]);

          $km_price = Setting::where('key','km_price')->first()->value_en;
          $cost = request()->distance * $km_price ;

          $inputs =  [
                'code' => $this->randToken(),
                'user_id' => auth('api')->id(),
                'start_lat' => request()->start_lat,
                'start_lng' => request()->start_lng,
                'end_lat' => request()->end_lat,
                'end_lng' => request()->end_lng,
                'distance' => request()->distance,
                'car_type' => request()->car_type,
                'gender' => request()->gender,
                'cost' => $cost,
                'status' => '0',
                ] ;
            if( request()->coupon_code )
            {
               $coupon = Coupon::where('code',request()->coupon_code)->first();
               if(empty($coupon))
               {
                return $this->apiResponse(['message' => trans('response.coupon_notvaild')],200);
               }elseif ($coupon->status == '0') {
                 return $this->apiResponse(['message' => trans('response.coupon_used')],200);
               }
               else {
                $inputs['coupon_code'] = $coupon->code;
                $inputs['coupon_value'] = $coupon->discount;
                $coupon->status = '0';
                $coupon->save();
               }
            }

        $inputs['req_expiration'] = date('Y-m-d h:i:s', strtotime(Carbon::now()->addSeconds(30))) ;
        $create = Order::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }


        // send notification to free drivers

        $drivers = Driver::where('status','1')->where('has_trip','0')->get();

        foreach ($drivers as $driver) {

          $driver->has_trip = '3' ;
          $driver->trip_id = $create->id ;
          $driver->save();

          OrderNotification::send($this->user->id,$driver->id,'1',$create->id,$this->user->username .' قام بأضافة رحلة جديدة',$this->user->username .' Has added New Trip');

            $content = $this->user->username .' '.trans('collection.order.storenotif');
            $this->_token = $driver->fcm_token;
          //  $this->sendFcm($this->_token,$this->_body,$content,$this->user->id,$create->id,'1','1');
            $this->sendFcm($this->_token,$this->_body,$content,$this->user,$create,'1','1');
        }

        return $this->apiResponse(['message' => trans('collection.order.store'),'data' => ['order_id' => $create->id ] ],200);
    }

    protected function randToken () {
        $token = rand(100000,999999);
        return (Order::where('code',$token)->first())?$this->randToken():$token;

    }

    private function sendFcm ($token,$body,$message,$sender,$create,$type,$contentType) {
            $data['tokens'][] = $token;
            $data['body'] = $body;
            $data['data']['message'] = $message;
            $data['data']['sender_id'] = $sender->id;
            $data['data']['sender_name'] = $sender->username;
            $data['data']['sender_image'] = ($sender->image != null)? config('user_storage').$sender->image :null;
            $data['data']['order_id'] = $create->id;
            $data['data']['start_lat'] = $create->start_lat;
            $data['data']['start_lng'] = $create->start_lng;
            $data['data']['end_lat'] = $create->end_lat;
            $data['data']['end_lng'] = $create->end_lng;
            $data['data']['created_at'] = $create->created_at->format('Y-m-d h:i:s');
            $data['data']['expir_at'] = $create->req_expiration;
            $data['data']['type'] = $type;
            $data['data']['content_type'] = $contentType;
            $data['data']['notifcation_type'] = 'new_order';
            return $this->send_fcm($data);

    }

}
