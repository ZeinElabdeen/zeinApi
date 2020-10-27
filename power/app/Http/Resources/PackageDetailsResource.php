<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageDetailsResource extends JsonResource
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
        $type = $this->type($this->type,request()->header('lang'));
        $notes = $this->notes($this->notes,request()->header('lang'));
//        $image = ($this->user->image != null)? config('user_storage').$this->user->image :null;

        return [
                'id' => $this->id,
                'start_lat' => $this->start_lat,
                'start_lng' => $this->start_lng,
                'end_lat' => $this->end_lat,
                'end_lng' => $this->end_lng,
                'arriving_date' => $this->arriving_date,
                'arriving_time' => $this->timeFormat($this->arriving_time),
                'id_number' => $this->id_number,
                'type' => $type,
                'type_value' => $this->type,
                'notes' => $notes,
                'notes_value' => $this->notes,
                'description' => $this->description,
                'status' => $status,
                'status_value' => $this->status,
                'created_at' => $this->created_at->format('H:i A'),
                'user' => [
                    'id'=>$this->user->id,
                    'username'=>$this->user->username,
                    'phone'=>$this->user->phone,
                    'image'=>($this->user->image != null)? config('user_storage').$this->user->image :null,
                ],

                'driver' => (!$this->driver) ? (object)[] : [
                    'id'=>$this->driver->id,
                    'username'=>$this->driver->username,
                    'phone'=>$this->driver->phone
                ],

                'images' => count($this->attaches) <= 0 ? (object) [] : new PackageImagesResource($this->attaches),
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

    private function type ($type,$lang = 'en'){
        if ($lang == 'ar') {
            switch ($type) {
                case '0':
                    return 'أوراق و مستندات';
                    break;
                case '1':
                    return 'مأكولات و مشروبات';
                    break;
                case '2':
                    return 'أخرى';
                    break;
            }
        }
        else{
            switch ($type) {
                case '0':
                    return 'Papers And Documents';
                    break;
                case '1':
                    return 'Food And Drinks';
                    break;
                case '2':
                    return 'Other';
                    break;
            }

        }
    }

    private function notes ($notes,$lang = 'en'){
        if ($lang == 'ar') {
            switch ($notes) {
                case '0':
                    return 'قابل للكسر';
                    break;
                case '1':
                    return 'درجة حرارة منخفضة';
                    break;
                case '2':
                    return 'لا يوجد';
                    break;
            }
        }
        else{
            switch ($notes) {
                case '0':
                    return 'Breakable';
                    break;
                case '1':
                    return 'Low Temperature';
                    break;
                case '2':
                    return 'No thing';
                    break;
            }

        }
    }

    public function timeFormat ($date) {
         $date =  new \DateTime($date);
        return $date->format('H:i A');
    }
}
