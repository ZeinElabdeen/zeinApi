<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use function foo\func;

class UserOrderResource extends ResourceCollection
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
            $lang = 'ar';
        }else{
            $lang = 'en';
        }

        return $this->collection->transform(function($data) use ($lang){
            $status = $this->status($data->status,$lang);

            return [
                'id' => $data->id,
                'code' => $data->code,
                'cost' => $data->total_cost,
                'items_count' => count($data->orderItems),
                'created_at' => $data->created_at->format('d/m/Y'),
                'status' => $status,
            ];
        });
    }
    public function status ($status,$lang) {
        if ($lang == 'ar') {
            switch ($status) {
                case '0' :
                    return 'جديد';
                    break;

                case '1' :
                    return 'تم التأكيد';
                    break;

                case '2' :
                    return 'تم الشحن';
                    break;

                case '3' :
                    return 'مرفوض';
                    break;

                case '4' :
                    return 'تم التسليم';
                    break;
            }
        }
        else {
            switch ($status) {
                case '0' :
                    return 'New';
                    break;

                case '1' :
                    return 'Confirmed';
                    break;

                case '2' :
                    return 'Underway';
                    break;

                case '3' :
                    return 'Refused';
                    break;

                case '4' :
                    return 'Delivered';
                    break;
            }
        }
    }
}

