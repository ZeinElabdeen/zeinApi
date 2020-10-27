<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\RoomContentCollection;
use App\Models\Message;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;


class OrderMessagesController extends ResponseController
{

    public function orderRoomMessages ($orderId) {
        $order_messages = Order::findOrFail($orderId);
      //  $order_messages = Order::findOrFail($orderId)->room->messages;
        if($order_messages->status == '0')
        {
          return response()->json(['message' => trans('response.order_not_confirmed')],444);
        }else{
           $image = ($order_messages->driver->image != null)? config('driver_storage').$order_messages->driver->image :null;
           $reciver  = array(
                                'id' => $order_messages->driver->id,
                                'name' => $order_messages->driver->username,
                                'phone' => $order_messages->driver->phone,
                                'rate' => $order_messages->driver->rate,
                                'image' => $image,
                            );

          return response()->json(['data'=> new RoomContentCollection($order_messages->room->messages) ,'reciver' => $reciver ]);
        }
    }
    public function driver_orderRoomMessages ($orderId) {
        $order_messages = Order::findOrFail($orderId);
        if($order_messages->status == '0')
        {
          return response()->json(['message' => trans('response.order_not_confirmed')],444);
        }else{
           $image = ($order_messages->user->image != null)? config('user_storage').$order_messages->user->image :null;
           $reciver  = array(
                                'id' => $order_messages->user->id,
                                'name' => $order_messages->user->username,
                                'phone' => $order_messages->user->phone,
                                'rate' => $order_messages->user->rate,
                                'image' => $image,
                            );

          return response()->json(['data'=> new RoomContentCollection($order_messages->room->messages) ,'reciver' => $reciver ]);
        }
    }

    private function checkRoomExist ($orderId) {
        $checkRoom = Room::first();

        return ($checkRoom == null) ? $this->createRoom($receiverId) : $checkRoom->id;
    }

}
