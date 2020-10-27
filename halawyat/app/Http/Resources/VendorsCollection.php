<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorsCollection extends ResourceCollection
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
            $image = ($data->image != null)? config('vendor_storage').$data->image :null;
            return [
                'id' => $data->id,
                'name' => $data->name,
                'rate' => $data->rate,
                'lat' => $data->lat,
                'lng' => $data->lng,
                'image' => $image,
            ];
        });
    }

}
