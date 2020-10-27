<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FaqResource extends ResourceCollection
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
            $description = 'description_ar';
            $title = 'title_ar';
        }else{
            $description = 'description_en';
            $title = 'title_en';
        }
        return $this->collection->transform(function($data) use ($title,$description){
            return [
                'id' => $data->id,
                'title' => $data->$title,
                'description' => $data->$description,

            ];
        });
    }
}
