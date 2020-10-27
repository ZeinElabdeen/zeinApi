<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(request('lang') == 'ar'){
            $message = 'message_ar';
        }else{
            $message = 'message_en';
        }

        return $this->collection->transform(function($data) use ($message){
            return [
                'id' => $data->id,
                'message' => $data->$message,
                'created_at' => $data->price,
            ];
        });
    }
}
