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

            return [
                'id' => $data->id,
                'vendor_id'   => $data->vendor->id,
                'vendor_name'   => $data->vendor->name,
                'vendor_image' => $image,

//                'item_details' => new AdResource($data->item),

            ];
        });
    }
}
