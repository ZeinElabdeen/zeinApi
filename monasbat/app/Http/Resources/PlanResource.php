<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlanResource extends ResourceCollection
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
            $description = 'description_ar';
        }else{
            $title = 'title_en';
            $description = 'description_en';
        }

        return $this->collection->transform(function($data) use ($title,$description){
            return [
                'id' => $data->id,
                'title' => $data->$title,
                'description' => $data->$description,
                'period' => $data->period,
                'price' => $data->price,
            ];
        });

    }
}
