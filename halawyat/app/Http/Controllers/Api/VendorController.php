<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemsCollection;
use App\Http\Resources\SubcategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VendorsCollection;
use App\Models\Item;
use App\Models\Category;
use App\Models\Vendor;
use Validator;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function show ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:categories,id'],
            ])->validate();
        $data = Vendor::findOrFail($id);

        $subcategories = $data->subcategories;
        $items = $data->items;

//        return $items;

        return response()->json(['data' => ['items' => (!$items)?[]: new ItemsCollection($items),
            'subcategories' => (!$subcategories) ?[]:new SubcategoriesCollection($subcategories)]]);

    }

}
