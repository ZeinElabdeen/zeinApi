<?php

namespace App\Http\Resources;

//use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class StatesCollection extends ResourceCollection
{

    public $title;
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
                'title' => $data->state,
            ];
        });
    }
}
