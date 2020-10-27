<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CancelReasonsCollection extends ResourceCollection
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
            $reason = 'reason_ar';
        }else{
            $reason = 'reason_en';
        }
        return $this->collection->transform(function ($data) use ($reason) {
            return [
                'reason' => $data->$reason,
                'id' => $data->id,
            ];
        });

    }
}
