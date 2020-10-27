<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubcategoriesCollection extends ResourceCollection
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

        return $this->collection->transform(function($data) use ($title){
            $image = ($data->image != null)? config('category_storage').$data->image :null;
            return [
                'id' => $data->id,
                'title' => $data->$title,
                'image' => $image,
            ];
        });
    }

}
