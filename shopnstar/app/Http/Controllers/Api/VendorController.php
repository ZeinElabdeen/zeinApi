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
                'id' => ['required','integer', 'exists:vendors,id'],
            ])->validate();
        $data = Vendor::where('id',$id)->get();

        return response()->json(['data' => new VendorsCollection($data)]);


    }

}
