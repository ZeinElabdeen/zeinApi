<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class
ItemRatesCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
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
                'item_id' => $data->item_id,
                'rate' => $data->rate,
                'review' => $data->review,
                'user_id'   => $data->user->id,
                'user_name'   => $data->user->username,
                'user_image' => $image,
                'created_at' => $data->created_at->format('d/m/Y h:i A'),

            ];
        });
    }
}
