<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorAttaches extends ResourceCollection
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
                'file_type' => explode("/",$data->file_type)[0],
                'image' => config('attach_storage').$data->image,
            ];
        });
    }
}
