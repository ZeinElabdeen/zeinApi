<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Resources\ItemsCollection;
//use App\Http\Resources\SubcategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CatsResource;
//use App\Models\Item;
use App\Models\Category;
use App\Models\Cats;
use Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    // public function vendorSubcategories () {
    //     $vendorubcategories = auth('vendor')->user()->category->subcategories;
    //     return response()->json(['data' => new SubcategoriesCollection($vendorubcategories),]);
    //
    // }

    public function vendorCategories () {
      //  $vendorcategories = auth('vendor')->user()->vendor;
        $vendorcategories = Category::where('vendor_id',auth('vendor')->user()->id)->get();
        return response()->json([ 'data' => new CategoryResource($vendorcategories) ]);

    }

    public function categories_list () {
      //  $data = Cats::get(['id','title','description','icon']);
        $list_selected = Category::where('vendor_id',auth('vendor')->user()->id)->get('cat_id')->toArray();
        $list_selected = array_column($list_selected,'cat_id');
        $datatemp = Cats::all();
         foreach ($datatemp as $row) {
          if(in_array($row->id, $list_selected) )
          {
            $row->is_selected = 1;
          }else{
            $row->is_selected = 0;
          }

        }

        return response()->json([ 'data' => new CatsResource($datatemp) ]);
    }

    public function update_cats_list () {

      $this->validate(request(),[
          'ids' => 'required|array',
          'ids.*' => 'required|integer|exists:cats,id',
      ]);
      $data = array();
      $vendor_id = auth('vendor')->user()->id;

      foreach (request()->ids as $id) {
        $is_exist = Category::where('vendor_id',$vendor_id)->where('cat_id',$id)->first();
          if(empty($is_exist))
          {
            $inputs  = array('vendor_id' => $vendor_id,'cat_id' => $id );
            $create= \DB::table('categories')->insert($inputs);
            if (!$create) {
                return response()->json(['message' => trans('response.failed')],444);
            }

          }
      }
      return response()->json(['message' => trans('collection.categories.success')],200);

    }

    public function vendorCategoriesAdd () {

       $vendor_id = auth('vendor')->user()->id;

       $this->validate(request(), [
           'title' => 'required|string',
           'description'    => 'required|string',
           'icon'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
       ]);

       // upload image
       if (request()->hasFile('icon')) {
           $imageName = md5(time()). '.'.request()->file('icon')->getClientOriginalExtension();
           $imageMove = request()->file('icon')->move(public_path('uploads/category'),$imageName);
           if (!$imageMove) {
               return  response()->json(['message' => trans('response.failed_image')],444);
           }
       }


       $inputs =  array('title' => request()->title,
                         'description' => request()->description,
                         'icon' => $imageName,
                         'vendor_id' => $vendor_id
                        );
      $data= \DB::table('categories')->insert($inputs);

       if (!$data) {
           return response()->json(['message' => trans('response.failed')],444);
       }
       return  response()->json(['message' => trans('collection.categories.success')],200);

    }

}
