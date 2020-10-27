<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdsCollection;
use App\Http\Resources\CategoriesCollection;
use App\Models\Ad;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        $categories = Category::all();
        $ads = Ad::all();
        return response()->json(['data' => ['categories' => new CategoriesCollection($categories),
            'ads' => new AdsCollection($ads)]]);
    }
}
