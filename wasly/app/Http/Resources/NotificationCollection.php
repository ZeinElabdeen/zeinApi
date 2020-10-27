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
        return $this->collection->transform(function($data) {
            return [
                'id' => $data->id,
                'body' => $data->body,
                'type' => $data->type,
                'order_id' => $data->order_id,
                'created_at' => $data->created_at->diffForHumans(),
            ];
        });
    }
}
