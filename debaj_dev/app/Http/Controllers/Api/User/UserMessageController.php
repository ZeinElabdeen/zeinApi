<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\RoomsCollection;
use App\Http\Resources\VendorResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Validator;


class UserMessageController extends Controller
{
    public function userRooms () {
//        $data = collect();
        $data = auth('api')->user()->senderRooms;
        $asReceiver = auth('api')->user()->receiverRooms;
        $data = $data->merge($asReceiver);
        return response()->json(['data' => new RoomsCollection($data)]);
    }

    public function RoomMessages ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:rooms,id']);
        $room = Room::findOrFail($id);
        $data = $room->messages;

        return response()->json(['data' => $data]);
    }

    public function checkExistsRoom () {
        request()->validate([
            'receiver_id' => 'required|integer|exists:users,id'
        ]);

        $senderId = auth('api')->id();
        $receiverId = request()->receiver_id;

        $checkRoom = Room::where(function ($q) use ($senderId,$receiverId) {
            $q->where('sender_id',$senderId)
                ->where('receiver_id',$receiverId);
        })->orWhere(function ($q) use ($senderId,$receiverId) {
            $q->where('receiver_id',$senderId)
                ->where('sender_id',$receiverId);
        })->first();

        if (!$checkRoom) {
            return response()->json(['data' => []]);
        }
        return $this->RoomMessages($checkRoom->id);
//        return response()->json(['data' => $data]);

    }


}
