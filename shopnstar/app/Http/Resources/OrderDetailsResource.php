<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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


        $paymentMethod = $this->paymentMethod($this->payment_method,$lang);
        return [
            'id' => $this->id,
            'code' => $this->code,
            'payment_method' => $paymentMethod,
            'order_cost' => $this->order_cost,
          //  'delivery_cost' => $this->delivery_cost,
            'total_cost' => $this->total_cost,
            'items_count' => count($this->orderItems),
            'lat' => $this->lat,
            'lng' => $this->lng,
            'created_at' => $this->created_at->format('d/m/Y h:i A'),
            'status' => $this->status,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->username
            ],
            'vendor' => [
                'id' => $this->vendor->id,
                'name' => $this->vendor->name
            ],
            'items' => new OrderItemsResource($this->orderItems),
        ];
    }

    public function paymentMethod ($attribute,$lang) {
        if ($lang == 'ar') {
            switch ($attribute) {
                case '1' :
                    return 'كاش';
                    break;

                case '2' :
                    return 'فيزا';
                    break;

                case '3' :
                    return 'ماستر كارد';
                    break;

                case '4' :
                    return 'مدى';
                    break;

                case '5' :
                    return 'سداد';
                    break;
            }
        }
        else {
            switch ($attribute) {
                case '1' :
                    return 'cash';
                    break;

                case '2' :
                    return 'visa';
                    break;

                case '3' :
                    return 'master card';
                    break;

                case '4' :
                    return 'mda';
                    break;

                case '5' :
                    return 'sdad';
                    break;
            }
        }
    }
}
