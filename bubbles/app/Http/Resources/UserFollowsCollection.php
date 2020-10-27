<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserFollowsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($data) {
            return [
                'id' => $data->club->id,
                'title' => $data->club->title,
                'logo' => config('club_storage').$data->club->logo,
                'city' => $data->club->city .' - المملكة العربية السعودية  ',
            ];
        });
    }
}
