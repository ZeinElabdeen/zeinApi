<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DriverDoneOrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
            $image = ($this->user->image != null)? config('user_storage').$this->user->image :null;
            return [
                'code' => $this->code,
                'id' => $this->id,
                'user' => [
                    'id' => $this->user->id,
                    'username' => $this->user->username,
                    'image' => $image,
                ],
              //  'pickup_time' => $this->pickup_time,
                'status' => $this->status,
                'created_at' => $this->created_at->format('h:i A'),
            ];
    }

}
