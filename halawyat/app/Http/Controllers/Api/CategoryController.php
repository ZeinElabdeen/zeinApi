<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemsCollection;
use App\Http\Resources\SubcategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VendorsCollection;
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
        $data = Category::findOrFail($id);

//        $subcategories = $data->subcategories;

        $vendors = $data->vendors;

        return response()->json(['data' => new VendorsCollection($vendors)]);

    }

    public function vendorSubcategories () {
        $vendorSubcategories = auth('vendor')->user()->category->subcategories;
        return response()->json(['data' => new SubcategoriesCollection($vendorSubcategories),]);

    }

}
