<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrdersCollection extends ResourceCollection
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
            $image = ($data->user->image != null)? config('user_storage').$data->user->image :null;
            return [
                'id' => $data->id,
                'start_lat' => $data->start_lat,
                'start_lng' => $data->start_lng,
                'end_lat' => $data->end_lat,
                'end_lng' => $data->end_lng,
                //'pickup_time' => $data->pickup_time,
                'user' => [
                    'username' => $data->user->username,
                    'image' => $image,
                ],
                'created_at' => $data->created_at->diffForHumans(),
            ];
        });
    }

}
