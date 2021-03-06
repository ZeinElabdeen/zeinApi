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

        return $this->collection->transform(function($data){
            return [
                'id' => $data->id,
                'vendor_id' => $data->vendor->id,
                'image' => config('user_storage').$data->vendor->image,

            ];
        });
    }
}
