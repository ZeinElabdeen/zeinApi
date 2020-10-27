<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\ResponseController;
use App\Models\Attach;
use App\Models\Driver;
use App\Models\Order;
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
                'pickup_time' => 'required|date|after:'.Carbon::now(),
                'description' => 'nullable|string',
                'type' => 'required|in:0,1',
                'car_type' => 'required_if:type,==,0|integer',
              //  'gender' => 'required_if:type,==,0|in:0,1',
                'gender' => 'nullable|integer|in:0,1',
                'payment_method' => 'required|in:0,1',
                'images' => 'required_if:type,==,1|array',
                'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
            ]);
        $create = Order::create([
            'code' => $this->randToken(),
            'user_id' => auth('api')->id(),
            'start_lat' => request()->start_lat,
            'start_lng' => request()->start_lng,
            'end_lat' => request()->end_lat,
            'end_lng' => request()->end_lng,
            'pickup_time' => request()->pickup_time,
            'car_type' => request()->car_type,
            'gender' => request()->gender,
            'payment_method' => request()->payment_method,
            'description' => request()->description,
            'type' => request()->type,
            'status' => '0',
            ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        if (request()->type == '1' && request()->hasFile('images')){
            $images = request()->file('images');
            foreach ($images as $index => $image) {
                $imageName = md5($index.time()). '.'.$image->getClientOriginalExtension();
                $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
                if (!$imageMove) {
                    return $this->apiResponse(['message' => trans('response.failed_image')],444);
                }
                Attach::create([
                    'order_id' => $create->id,
                    'image' => $imageName
                ]);
            }
        }

        // send notification

        $drivers = Driver::where('service',request()->type)->get();

        foreach ($drivers as $driver) {
            OrderNotification::send($this->user->id,$driver->id,'1',$create->id,'طلب جديد','new order');

            $content = $this->user->username .' : '.trans('collection.order.store');
            $this->_token = $driver->fcm_token;
            $this->sendFcm($this->_token,$this->_body,$content,$this->user->id,$create->id,'4','1');

        }

        return $this->apiResponse(['message' => trans('collection.order.store')],200);
    }

    protected function randToken () {
        $token = rand(100000,999999);
        return (Order::where('code',$token)->first())?$this->randToken():$token;

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
