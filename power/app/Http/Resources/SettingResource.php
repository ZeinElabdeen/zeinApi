<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingResource extends ResourceCollection
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
            $value = 'value_ar';
        }else{
            $value = 'value_en';
        }
        return $this->collection->transform(function ($data) use ($value) {
            return [
                $data->key => $data->$value,
            ];
        });

    }
}
