<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdResource;
use App\Http\Resources\CategoryResource;
use App\Models\Ad;
use App\Models\Item;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // newest 5 offers , all categories , all ads
    public function index () {
        $categories = Category::orderBy('id','desc')->get();
        $ads = Ad::orderBy('id','desc')->get();
        return response()->json(['data' => ['ads'=>new AdResource($ads),
            'categories' => new CategoryResource($categories)]]);
    }
}
