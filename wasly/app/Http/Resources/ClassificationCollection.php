<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassificationCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(request()->header('lang') == 'ar'){
            $title = 'title_ar';
            $this->title = 'title_ar';
        }else{
            $title = 'title_en';
            $this->title = 'title_en';
        }

        return $this->collection->transform(function($data){
            $image = ($data->image == null) ? null: config('classification_storage').$data->image;
            return [
                'id' => $data->id,
                'title' => $data->title,
                'image' => $image,
            ];
        });
    }

    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('ad_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
