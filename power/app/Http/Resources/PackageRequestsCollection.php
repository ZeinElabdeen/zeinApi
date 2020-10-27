<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PackageRequestsCollection extends ResourceCollection
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
                'id' => $data->id,
                'cost' => $data->cost,
                'package_id' => $data->package_id,
                'created_at' => $data->created_at->format('Y-m-d'),
                'driver' => [
                    'id' => $data->driver->id,
                    'username' => $data->driver->username,
                    'image' => ($data->driver->image != null)? config('driver_storage').$data->driver->image :null,
                ],
            ];
        });
    }
}
