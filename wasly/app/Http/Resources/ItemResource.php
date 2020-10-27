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
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'rate' => $this->rate,
            'images' => ($this->attaches == null) ?(object)[]: new ItemAttaches($this->attaches),
            'details' => ($this->details == null) ?(object)[]: new ItemDetailsCollection($this->details),
            'first_two_rates' => ($this->firstTwoRates == null) ?(object)[]: new ItemRatesCollection($this->firstTwoRates)
        ];
    }

}
