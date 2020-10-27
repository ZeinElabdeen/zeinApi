<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $title = ($request->header('lang') == 'ar')? 'title_ar' : 'title_en';

        $image = ($this->image != null)? config('vendor_storage').$this->image :null;
        return [
            'id' => $this->id,
            'username' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'description' => $this->delivery_time,
            'lat' => $this->lat,
            'lng' => $this->lng,
            //'category' => $this->category->$title,
            'image' => $image,
        ];
    }
}
