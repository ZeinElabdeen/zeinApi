<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FavoriteResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(request()->header('lang') == 'ar'){
            $title = 'title_ar';
            $this->title = 'title_ar';
        }else{
            $title = 'title_en';
            $this->title = 'title_en';
        }

        return $this->collection->transform(function($data) use ($title){
            return [
                'id' => $data->id,
                'item_details'  => $data->ad == null ? (object) [] :  (object) [
                    'id'   => $data->ad->id,
                    'title' => $data->ad->$title,
                    'price' => $data->ad->price,
                    'size' => $data->ad->size->$title,
                    'category' => $data->ad->category->$title,
                    'category_id' => $data->ad->category->id,
                    'image' => config('ad_storage').$data->ad->image,
                ],

//                'item_details' => new AdResource($data->ad),

            ];
        });
    }
}
