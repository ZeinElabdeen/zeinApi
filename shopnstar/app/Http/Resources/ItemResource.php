<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

            return [
//                'is_favorite' => $this->isFavorite($this->id),
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'discount' => $this->discount,
                'images' => (count($this->attaches) > 0 ) ?new ItemAttaches($this->attaches) : [],
                'rates' => (count($this->rates) > 0 ) ? new ItemRatesCollection($this->rates) : [],
            ];
    }

//    private function isFavorite ($id) {
//        $isFavorite = Favorite::where('user_id',auth('api')->id())
//            ->where('ad_id',$id)->first();
//        return ($isFavorite)? true :false;
//    }
}
