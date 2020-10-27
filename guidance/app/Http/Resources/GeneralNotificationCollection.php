<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GeneralNotificationCollection extends ResourceCollection
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

              if($data->type == '0'){
                return [
                    'id' => $data->id,
                    'message' => $data->$message,
                    'is_read' => $data->is_read,
                    'order_id' => $data->order_id,
                    'order_status' => $data->order_data['status'],
                    'driver_id' => $data->driver_id,                
                    'created_at' => $data->created_at->format('Y-m-d'),
                ];
              }else{
                return [
                    'id' => $data->id,
                    'message' => $data->$message,
                    'is_read' => $data->is_read,
                    'order_id' => $data->order_id,
                    'order_status' => $data->order_data['status'],
                    'created_at' => $data->created_at->format('Y-m-d'),
                 ];
              }


        });
    }
}
