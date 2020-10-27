<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BrandCollection;
use App\Http\Resources\CategoryAdsResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoriesResource;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Category;
use Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index () {
        $data = Category::get();

        return response()->json(['data' => new CategoryResource($data)]);
    }

    public function show ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:categories,id'],
            ])->validate();
        $data = Brand::where('category_id',$id)->where('city_id',auth('api')->user()->city_id)->get();
//return $data;
        return response()->json(['data' => new BrandCollection($data),]);

    }
}
