<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class
FavoriteResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if(request()->header('lang') == 'ar'){
        //     $title = 'title_ar';
        //     $this->title = 'title_ar';
        // }else{
        //     $title = 'title_en';
        //     $this->title = 'title_en';
        // }

        return $this->collection->transform(function($data) {

            return [
                'id' => $data->id,
                'item_id'   => $data->item->id,
                'title' => $data->item->title,
                'price' => $data->item->price,
                'image' => new ItemAttaches($data->item->firstAttach),

//                'item_details' => new AdResource($data->item),

            ];
        });
    }
}
