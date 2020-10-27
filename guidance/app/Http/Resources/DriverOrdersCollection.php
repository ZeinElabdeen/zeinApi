<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DriverOrdersCollection extends ResourceCollection
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
                'code' => $data->code,
                'id' => $data->id,
                'user' => [
                    'id' => $data->user->id,
                    'username' => $data->user->username,
                    'image' => $image,
                ],
                'status' => $data->status,
                'created_at' => $data->created_at->format('h:i A'),
            ];
        });
    }

}
