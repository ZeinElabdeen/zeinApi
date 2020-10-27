<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingsCollection extends ResourceCollection
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
            $value = 'value_ar';
        }else{
            $value = 'value_en';
        }

        return $this->collection->transform(function($data) use ($value) {
            return [
                'key' => $data->key,
                'value' => $data->$value,
            ];
        });
    }
}
