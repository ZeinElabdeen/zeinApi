<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Resources\ItemsCollection;
use App\Http\Resources\SubcategoriesCollection;
use App\Http\Resources\VendorsCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Item;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Vendor;

class HomeController extends Controller
{
    public function index () {
        $vendor = auth('vendor')->user();

        $subcategories = $vendor->category->filledSubcategories;
        return $subcategories;
        $items = $vendor->items;
return $items;
        return response()->json(['data' => ['items' => (!$items)?[]: new ItemsCollection($items),
            'subcategories' => (!$subcategories) ?[]:new SubcategoriesCollection($subcategories)]]);

    }
}
