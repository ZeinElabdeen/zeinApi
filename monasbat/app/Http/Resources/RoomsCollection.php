<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($data) {
            return [
                'id' => $data->id,
                'last_message' => ($data->lastMessage) ? $data->lastMessage->content :null  ,
                'last_message_date' => ($data->lastMessage) ? $data->lastMessage->created_at->format('Y-m-d h:i A') :null  ,
                'read' => $data->lastMessage->read  ,
                'receiver' => (auth('api')->id() == $data->receiver->id)? (object) [
                    'id' => $data->sender->id,
                    'username' => $data->sender->username,
                    'image' => ($data->sender->image != null)? config('user_storage').$data->sender->image :null,
                ]: (object) [
                    'id' => $data->receiver->id,
                    'username' => $data->receiver->username,
                    'image' => ($data->receiver->image != null)? config('user_storage').$data->receiver->image :null,
                ],
//                'sender' => [
//                    'id' => $data->sender->id,
//                    'username' => $data->sender->username,
//                ],
//                'image' => config('user_storage').$data->image,
            ];
        });
    }
}
