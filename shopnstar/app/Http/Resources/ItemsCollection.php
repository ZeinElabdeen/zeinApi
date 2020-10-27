<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemsCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if(request()->header('lang') == 'ar'){
        //     $title = 'title_ar';
        //     $this->title = 'title_ar';
        // }else{
        //     $title = 'title_en';
        //     $this->title = 'title_en';
        // }

        return $this->collection->transform(function($data){
            return [
                'is_favorite' => $this->isFavorite($data->id),
                'id' => $data->id,
                'title' => $data->title,
                'description' => $data->description,
                'price' => $data->price,
                'discount' => $data->discount,
                'image' =>  new ItemAttaches($data->firstAttach)
            ];
        });
    }

    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('item_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
