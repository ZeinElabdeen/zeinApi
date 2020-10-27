<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Room;
class RoomContentCollection extends ResourceCollection
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

            $room = Room::where('id',$data->room_id)->first();

            return [
                'id' => $data->id,
                'content' => $data->content,
                'content_type' => $data->content_type,
                'type' => $data->type,
                'created_at' => $data->created_at->format('d/m/Y h:i A'),
                'sender' => ($data->type == '0')? [
                    'username' => $room->user->username,
                    'image' =>  ($room->user->username != null)? config('user_storage').$room->user->image :null,
                ]:[
                    'username' => $room->driver->username,
                    'image' =>  ($room->driver->username != null)? config('driver_storage').$room->driver->image :null,

                ],
            ];
        });
    }
}
