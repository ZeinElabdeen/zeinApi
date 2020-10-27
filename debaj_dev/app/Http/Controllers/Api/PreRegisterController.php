<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdsCollection;
use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\CitiesCollection;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\City;

class PreRegisterController extends Controller
{
    public function index () {
        $categories = Category::all();
        $cities = City::all();
        return response()->json(['data' => ['categories' => new CategoriesCollection($categories),
            'cities' => new CitiesCollection($cities)]]);
    }
}
