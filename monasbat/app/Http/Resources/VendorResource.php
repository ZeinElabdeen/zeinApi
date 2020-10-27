<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use App\Models\City;
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
        $image = ($this->image != null)? config('user_storage').$this->image :null;
        $coverImage = ($this->vendorDetails != null)? config('user_storage').$this->vendorDetails->cover_image :null;

        $city = City::where('id',$this->city_id)->first();
        if(request()->header('lang') == 'ar'){
            $city = $city->title_ar;
        }else{
            $city = $city->title_en;
        }
        return [
            'is_favorite' => $this->isFavorite($this->id),
            'id' => $this->id,
            'type' => $this->type,
            'username' => $this->username,
            'phone' => $this->phone,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'is_ad' => $this->is_ad,
            'city' =>$city,
            'image' => $image,
            'gallery' => new VendorAttaches($this->attaches),
            'cover_image' => $coverImage,
            'details' =>  new VendorDetailsResource($this->vendorDetails),
        ];
    }
    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('vendor_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
