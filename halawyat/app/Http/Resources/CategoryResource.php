<?php

namespace App\Http\Resources;

//use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class CategoryResource extends ResourceCollection
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
        if(request()->header('lang') == 'ar'){
            $title = 'title_ar';
            $this->title = 'title_ar';
        }else{
            $title = 'title_en';
            $this->title = 'title_en';
        }

        return $this->collection->transform(function($data) use ($title){
            return [
                'id' => $data->id,
                'title' => $data->$title,
                'icon' => $data->icon,
            ];
        });

    }

//    public function sub ($data) {
//        $title = $this->get_title();
//        $sub = collect();
//        $temp = array();
//        if (count($data->children) > 0){
//            foreach ($data->children as $child) {
////                array_push($temp,$child->id,$child->$title);
//                $temp[] = $child->id;
//                $sub->push($temp);
//            }
//
//            return $sub;
//        }
//
//        return null;
//    }
//
//    public function get_title() {
//        return $this->title;
//    }
}
