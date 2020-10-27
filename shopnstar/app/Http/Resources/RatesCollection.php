<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class
RatesCollection extends ResourceCollection
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
            $image = ($data->vendor->image != null)? config('vendor_storage').$data->vendor->image :null;
            $image_user = ($data->user->image != null)? config('user_storage').$data->user->image :null;

            return [
                'id' => $data->id,
                'rate' => $data->rate,
                'review' => $data->review,

                'vendor_id'   => $data->vendor->id,
                'vendor_name'   => $data->vendor->name,
                'vendor_image' => $image,

                'user_id'   => $data->user->id,
                'user_name'   => $data->user->username,
                'user_image' => $image_user,

//                'item_details' => new AdResource($data->item),

            ];
        });
    }
}
