<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class VendorDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $coverImage = ($this->cover_image != null)? config('user_storage').$this->cover_image :null;
        return [
            'id' => $this->id,
            'rate' => $this->rate,
            'description' => $this->description,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'cover_image' => $coverImage,
            'subscription_end' => ($this->subscription_end == null)? false : $this->subscriptionInDays($this->subscription_end),
        ];
    }

    public function subscriptionInDays ($date) {
        $date =  new \DateTime($date);
        $today = new \DateTime();
        $result = date_diff($date,$today);
        return $result->days;
    }
}
