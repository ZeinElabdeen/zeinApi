<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        $deliveryTime = $this->deliveryTime($this->delivery_time,$lang);
        $repeat = $this->repeat($this->repeat,$lang);
        return [
            'is_favorite' => $this->isFavorite($this->id),
            'id' => $this->id,
            'code' => $this->code,
            'payment_method' => $paymentMethod,
            'delivery_time' => $deliveryTime,
            'repeat' => $repeat,
            'order_cost' => $this->order_cost,
            'tax' => $this->tax,
            'total_cost' => $this->total_cost,
            'from_wallet' => $this->from_wallet,
            'cash_req' => $this->cash_req,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'created_at' => $this->created_at->format('d/m/Y'),
            'status' => $this->status,
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

    public function deliveryTime ($attribute,$lang) {
        if ($lang == 'ar') {
            switch ($attribute) {
                case '1' :
                    return 'صباحاً';
                    break;

                case '2' :
                    return 'مساءاً';
                    break;

                case '3' :
                    return 'في أي وقت';
                    break;
            }
        }
        else {
            switch ($attribute) {
                case '1' :
                    return 'morning';
                    break;

                case '2' :
                    return 'night';
                    break;

                case '3' :
                    return 'any time';
                    break;
            }
        }
    }

    public function repeat ($attribute,$lang) {
        if ($lang == 'ar') {
            switch ($attribute) {
                case '1' :
                    return 'مرة واحدة';
                    break;

                case '2' :
                    return 'كل أسبوعين';
                    break;

                case '3' :
                    return 'كل شهر';
                    break;
            }
        }
        else {
            switch ($attribute) {
                case '1' :
                    return 'once';
                    break;

                case '2' :
                    return 'every 2 weeks';
                    break;

                case '3' :
                    return 'every month';
                    break;

            }
        }
    }

    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('order_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
