<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdResource extends ResourceCollection
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
          if(!empty($data->discount))
          {
            $price = $data->price - ( $data->price * $data->discount/100 );
          }
          else{
            $price = $data->price ;
          }
            return [
                'is_favorite' => $this->isFavorite($data->id),
                'id' => $data->id,
                'stock' => $data->stock,
                'title' => $data->$title,
                'price' => $price,
                'price_befor_discount' =>$data->price ,
                'size' => $data->size->$title,
                'category' => $data->category->$title,
                'category_id' => $data->category->id,
                'image' => config('ad_storage').$data->image,
            ];
        });
    }

    private function isFavorite ($id) {
        $isFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('ad_id',$id)->first();
        return ($isFavorite)? true :false;
    }
}
