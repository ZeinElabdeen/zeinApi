<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $image = ($this->image != null)? config('driver_storage').$this->image :null;
        return [
            'id' => $this->id,
            'username' => $this->username,
            'phone' => $this->phone,
            'wallet' => $this->wallet,
//            'rate' => $this->rate,
            'image' => $image,
//            'license_image' => $licenseImage,
        ];
    }
}
