<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemRatesCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($data) {
            return [
                'id' => $data->id,
                'rate' => $data->rate,
                'review' => $data->review,
                'username' => ($data->user == null)? (object)[]:(object)[
                    'first_name' => $data->user->first_name,
                    'last_name' => $data->user->last_name
                ],
                'created_at' => $data->created_at->format('d M Y'),
            ];
        });
    }
}
