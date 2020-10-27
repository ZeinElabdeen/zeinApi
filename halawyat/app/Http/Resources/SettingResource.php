<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
        return [
            'key' => $this->key,
            'value' => $this->value_ar,
        ];
      }else{
        return [
            'key' => $this->key,
            'value' => $this->value_en,
        ];
      }

    }
}
