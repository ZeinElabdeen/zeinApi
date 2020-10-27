<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewPackagesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($data) {
            $status = $this->status($data->status,request()->header('lang'));
            return [
                'id' => $data->id,
                'start_lat' => $data->start_lat,
                'start_lng' => $data->start_lng,
                'end_lat' => $data->end_lat,
                'end_lng' => $data->end_lng,
                'arriving_date' => $data->arriving_date,
                'arriving_time' => $data->arriving_time,
                'status' => $status,
                'created_at' => $data->created_at->format('H:i'),
            ];
        });
    }

    private function status ($status,$lang = 'en'){
        if ($lang == 'ar') {
            switch ($status) {
                case '0':
                    return 'لم يتم تحديد السائق';
                    break;
                case '1':
                    return 'بإنتظار الشحن';
                    break;
                case '2':
                    return 'تم الشحن';
                    break;
                case '3':
                    return 'تم التوصيل';
                    break;
                case '4':
                    return 'ملغي';
                    break;
            }
        }
        else{
            switch ($status) {
                case '0':
                    return 'Waiting For Choosing Driver';
                    break;
                case '1':
                    return 'Waiting For Transaction';
                    break;
                case '2':
                    return 'Underway';
                    break;
                case '3':
                    return 'Delivered';
                    break;
                case '4':
                    return 'Canceled';
                    break;
            }

        }
    }
}
