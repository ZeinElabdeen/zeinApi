<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;


class MessageController extends ResponseController
{
    private $_token,$_receiverId,$_body = 'لديك رسالة جديدة';

    public function send () {
        request()->validate([
            'receiver_id' => 'required|integer',
            'type' => 'required|integer',
        ]);
        if (request()->type == '1') {
            request()->validate([
                'content' => 'required|image|max:5120',
            ]);
            if (request()->hasFile('content')) {
                $imageName = md5(time()). '.'.request()->file('content')->getClientOriginalExtension();
                $imageMove = request()->file('content')->move(public_path('uploads/user'),$imageName);
                if (!$imageMove) {
                    return $this->apiResponse(['message' => trans('response.failed_image')],444);
                }
                $content = $imageName;
            }
        }
        else{
            request()->validate([
                'content' => 'required|string|max:255',
            ]);
            $content = request('content');
        }

        $senderId = auth('api')->id();
        $receiverId = $this->_receiverId = request()->receiver_id;

        $this->_token = User::where('id',request()->receiver_id)->pluck('fcm_token')->first();
//        return $this->_token;

        $roomId = $this->checkRoomExist($senderId,$receiverId);

        return $this->createMessage($roomId,request()->type,$content);
    }

    private function createRoom ($receiverId) {
        $create = Room::create([
            'sender_id' => auth('api')->id(),
            'receiver_id' => $receiverId,
        ]);

        return (!$create) ? false : $create->id;
    }

    private function checkRoomExist ($senderId,$receiverId) {
        $checkRoom = Room::where(function ($q) use ($senderId,$receiverId) {
            $q->where('sender_id',$senderId)
                ->where('receiver_id',$receiverId);
        })->orWhere(function ($q) use ($senderId,$receiverId) {
            $q->where('receiver_id',$senderId)
                ->where('sender_id',$receiverId);
        })->first();

        return ($checkRoom == null) ? $this->createRoom($receiverId) : $checkRoom->id;
    }

    private function createMessage ($room,$type,$content) {
        $create = Message::create([
            'user_id' => auth('api')->id(),
            'room_id' => $room,
            'type' => $type,
            'content' => $content,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->sendFcm($this->_token,$this->_body,$content,auth('api')->id(),$this->_receiverId,$create->room_id,'0');
//        return $this->apiResponse(['message' => trans('collection.contact.success')],200);
    }

    private function sendFcm ($token,$body,$message,$senderId,$receiverId,$roomId,$type) {
            $data['tokens'][] = $token;
            $data['body'] = $body;
            $data['data']['message'] = $message;
            $data['data']['sender_id'] = $senderId;
            $data['data']['receiver_id'] = $receiverId;
            $data['data']['room_id'] = $roomId;
            $data['data']['type'] = $type;
            return $this->send_fcm($data);

    }
}
