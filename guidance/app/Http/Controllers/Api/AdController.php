<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdsCollection;
use App\Http\Resources\CategoriesCollection;
use App\Models\Ad;
use App\Models\Category;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function index () {
        $ads = Ad::all();
        return response()->json(['data' => ['ads' => new AdsCollection($ads)]]);
    }
}
