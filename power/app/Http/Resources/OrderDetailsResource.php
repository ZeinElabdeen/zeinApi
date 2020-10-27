<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $status = $this->status($this->status,request()->header('lang'));
        $image = ($this->user->image != null)? config('user_storage').$this->user->image :null;

        return [
        //    'type' => $this->type,
            'id' => $this->id,
            'start_lat' => $this->start_lat,
            'start_lng' => $this->start_lng,
            'end_lat' => $this->end_lat,
            'end_lng' => $this->end_lng,
          //  'pickup_time' => $this->pickup_time,
        //    'description' => $this->description,
            'status' => $status,
                'created_at' => $this->created_at->format('H:i A'),
                'user' => [
                    'username' => $this->user->username,
                    'image' => $image,
                ],
//                'driver' => (!$this->driver) ? (object)[] : [
//                    'id'=>$this->driver->id,
//                    'username'=>$this->driver->username,
//                    'phone'=>$this->driver->phone
//                ],

      //          'images' => count($this->attaches) <= 0 ? [] : new PackageImagesResource($this->attaches),
            ];
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


    public function timeFormat ($date) {
         $date =  new \DateTime($date);
        return $date->format('H:i A');
    }
}
