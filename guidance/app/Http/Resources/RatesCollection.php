<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RatesCollection extends ResourceCollection
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
            return [
                'id' => $data->id,
                'rate' => $data->rate,
                'review' => $data->review,
                'created_at' => $data->created_at->format('Y-m-d h:i A'),
                'user' => ($data->user_id == null)? (object)[]: (object)[
                    'id' => $data->user->id,
                    'username' => $data->user->username,
                    'image' => ($data->user->image != null)? config('user_storage').$data->user->image :null
                ],
                'driver' => ($data->driver_id == null)? (object)[]: (object)[
                    'id' => $data->driver->id,
                    'username' => $data->driver->username,
                    'image' => ($data->driver->image != null)? config('driver_storage').$data->driver->image :null
                ],

            ];
        });
    }
}
