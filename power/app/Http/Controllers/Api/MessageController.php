<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Message;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;


class MessageController extends ResponseController
{
    private $_token,$_body = 'لديك رسالة جديدة';

    public function sendMessage () {
        request()->validate([
            'order_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'type' => 'required|integer|in:0,1',
            'content_type' => 'required|integer|in:1,2,3',
            'message' => 'required',
        ]);

        switch (request()->content_type) {
            case 1:
                request()->validate([
                    'message' => 'required|string|max:255',
                ]);
                $content = request()->message;
                break;
            // image case
            case 2:
                request()->validate([
                    'message' => 'required|image|mimes:jpg,jpeg,png|max:5120',
                ]);
                $content = $this->uploadAttach(request()->message,request()->content_type);
                break;
                // voice case
            case 3:
                request()->validate([
                    'message' => 'required|mimes:mpga,wav,mp3|max:5120',
                ]);
                $content = $this->uploadAttach(request()->message,request()->content_type);
                break;
            default:
                return $this->apiResponse(['message' => trans('response.failed')],444);
        }

        $order = Order::findOrFail(request()->order_id);

        $this->_token = $order->driver->fcm_token;
        $roomId = $order->room->id;
        $senderId = request()->sender_id;

        return $this->createMessage($roomId,request()->content_type,$content,$senderId,request()->type);
    }

    public function createRoom ($driverId,$orderId) {
        $create = Room::create([
            'user_id' => $this->user->id,
            'driver_id' => $driverId,
            'order_id' => $orderId,
        ]);

        return (!$create) ? false : $create->id;
    }

    private function checkRoomExist ($userId,$driverId,$orderId) {
        $checkRoom = Room::where(function ($q) use ($userId,$driverId,$orderId) {
            $q->where('user_id',$userId)
                ->where('driver_id',$driverId)
                ->where('order_id',$orderId);
        })->orWhere(function ($q) use ($userId,$driverId,$orderId) {
            $q->where('user_id',$userId)
                ->where('driver_id',$driverId)
                ->where('order_id',$orderId);
        })->first();

        return ($checkRoom == null) ? $this->createRoom() : $checkRoom->id;
    }

    private function createMessage ($room,$contentType,$content,$senderId,$type) {
        $create = Message::create([
            'sender_id' => $senderId,
            'room_id' => $room,
            'content_type' => $contentType,
            'type' => $type,
            'content' => $content,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->sendFcm($this->_token,$this->_body,$content,$create->sender_id,$create->room_id,$type,$contentType);
//        return $this->apiResponse(['message' => trans('collection.contact.success')],200);
    }

    private function sendFcm ($token,$body,$message,$senderId,$orderId,$type,$contentType) {
            $data['tokens'][] = $token;
            $data['body'] = $body;
            $data['data']['message'] = $message;
            $data['data']['sender_id'] = $senderId;
            $data['data']['order_id'] = $orderId;
            $data['data']['type'] = $type;
            $data['data']['content_type'] = $contentType;
            return $this->send_fcm($data);

    }

    private function uploadAttach ($content,$type) {
        $path = ($type == '2' ) ? 'image' : 'voice';
        $name = md5(time()). '.'.$content->getClientOriginalExtension();
        $move = $content->move(public_path('uploads/messages/'.$path),$name);
        if (!$move) {
            return $this->apiResponse(['message' => trans('response.failed_image')],444);
        }
        return $name;
    }
}
