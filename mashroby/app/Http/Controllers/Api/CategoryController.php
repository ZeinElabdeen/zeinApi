<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdResource;
use App\Http\Resources\CategoryAdsResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoriesResource;
use App\Models\Ad;
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
        $ads = $this->categoryAds($id);
//return $data;
        return response()->json(['ads' => new AdResource($ads),]);

    }

    public function categoryAds ($id) {
        $data = Ad::where('category_id',$id)->get();
        return $data;
    }
}
