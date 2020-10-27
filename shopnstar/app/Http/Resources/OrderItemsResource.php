<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderItemsResource extends ResourceCollection
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
        }else{
            $title = 'title_en';
        }

        return $this->collection->transform(function($data) use ($title){
            return [
                'id' => $data->itemDetails->id,
                'title' => $data->itemDetails->title,
                'count' => $data->count,
                'price' => $data->price,
            ];
        });
    }
}
