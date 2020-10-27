<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
            $image = ($data->image != null)? config('user_storage').$data->image :null;
            return [
            'is_favorite' => $this->isFavorite($data->id),
            'id' => $data->id,
            'username' => $data->username,
            'image' => $image,
            'lat' => $data->lat,
            'lng' => $data->lng,
//            'rate' => $data->rate,
        ];

        });
    }
    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('vendor_id',$id)->first();
        return ($isFavorite)? true :false;
    }

}
