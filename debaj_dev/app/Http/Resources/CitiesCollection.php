<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CitiesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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

        return $this->collection->transform(function($data) use ($title) {
            return [
                'id' => $data->id,
                'title' => $data->$title,
            ];
        });
    }
}
