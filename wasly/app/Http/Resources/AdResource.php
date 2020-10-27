<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return $this->collection->transform(function($data){
            $image = ($data->image == null) ? null: config('ad_storage').$data->image;
            return [
                'id' => $data->id,
                'image' => $image,
            ];
        });
    }


}
