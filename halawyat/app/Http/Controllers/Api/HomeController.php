<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VendorsCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Item;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Vendor;

class HomeController extends Controller
{
    public function index () {
        $categories = Category::where('parent_id',null)->get();
        $vendors = Vendor::get();
        return response()->json(['data' => ['categories' => new CategoryResource($categories),
            'vendors'=> new VendorsCollection($vendors),]]);
    }
}
