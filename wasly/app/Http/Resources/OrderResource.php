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

        return [
            'id' => $this->id,
            'code' => $this->code,
            'order_cost' => $this->order_cost,
            'discount' => $this->coupon_discount,
            'shipping_cost' => $this->total_cost,
            'total_cost' => $this->total_cost,
            'created_at' => $this->created_at->format('d/m/Y'),
            'status' => $this->status($this->status,$lang),
            'items' => new OrderItemsResource($this->orderItems),
        ];
    }
    public function status ($status,$lang) {
        if ($lang == 'ar') {
            switch ($status) {
              case '0' :
            return 'طلب جديد';
            break;

        case '1' :
            return 'تم تاكيد طلبك';
            break;

            case '2' :
                return 'مرفوض';
                break;

            case '3' :
                return 'جاري الشحن';
                break;

        case '4' :
            return 'تم استلام الطلب';
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
                    return 'Refused';
                    break;

                case '3' :
                    return 'Underway';
                    break;

                case '4' :
                    return 'Delivered';
                    break;
            }
        }
    }

}
