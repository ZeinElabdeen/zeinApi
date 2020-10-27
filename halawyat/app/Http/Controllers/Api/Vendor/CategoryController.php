<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Resources\ItemsCollection;
use App\Http\Resources\SubcategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Item;
use App\Models\Category;
use Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function vendorSubcategories () {
        $vendorubcategories = auth('vendor')->user()->category->subcategories;
        return response()->json(['data' => new SubcategoriesCollection($vendorubcategories),]);

    }

}
