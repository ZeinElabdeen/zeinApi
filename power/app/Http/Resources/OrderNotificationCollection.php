<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderNotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->header('lang') == 'ar'){
            $message = 'message_ar';
        }
        else{
            $message = 'message_en';
        }

        return $this->collection->transform(function($data) use ($message){
            $image = ($data->image != null)? config('driver_storage').$data->image :null;
            return [
                'id' => $data->id,
                'driver' => [
                    'name' => $data->driver->username,
                    'image' => $image,
                ],
                'message' => $data->$message,
                'is_read' => $data->is_read,
                'order_id' => $data->order_id,
                'created_at' => $data->created_at->format('Y-m-d'),

            ];
        });
    }
}
