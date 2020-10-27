<?php

namespace App\Http\Resources;

//use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class CatsResource extends ResourceCollection
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

            $image = ($data->icon != null)? config('category_storage').$data->icon :null;
            return [

                'cat_id' => $data->id,
                'title' => $data->title,
                'description' => $data->description,
                'is_selected' => $data->is_selected,
                'icon' => $image,
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
