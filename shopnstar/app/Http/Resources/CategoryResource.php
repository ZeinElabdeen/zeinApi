<?php

namespace App\Http\Resources;
use App\Models\Vendor;
use App\Models\Cats;
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


        return $this->collection->transform(function($data) {

            $vendor = Vendor::findOrFail($data->vendor_id);
            $categorydetails = Cats::findOrFail($data->cat_id);
            $image = ($categorydetails->icon != null)? config('category_storage').$categorydetails->icon :null;
            return [
                'id' => $data->id,
                'cat_id' => $categorydetails->id,
                'title' => $categorydetails->title,
                'description' => $categorydetails->description,
                'icon' => $image,
                'vendor' => [
                     'id' =>$vendor->id,
                     'name' =>$vendor->name,
                ],

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
