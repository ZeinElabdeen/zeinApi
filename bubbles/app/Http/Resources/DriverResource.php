<?php

namespace App\Http\Resources;
use App\Models\Rate;
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
        $licenseImage = ($this->driving_license != null)? config('driver_storage').$this->driving_license :null;
        $numbers_rates = Rate::where('driver_id', '=', $this->id)->get();
        $numbers_rates = $numbers_rates->count();
        return [
            'id' => $this->id,
            'username' => $this->username,
            'phone' => $this->phone,
            'rate' => $this->rate,
            'numbers_rates' => $numbers_rates,
            'id_number' => $this->id_number,
            'image' => $image,
            'license_image' => $licenseImage,
        ];
    }
}
