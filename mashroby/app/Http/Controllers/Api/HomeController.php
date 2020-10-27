<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdResource;
use App\Http\Resources\CategoryResource;
use App\Models\Ad;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // newest 5 offers , all categories , all ads
    public function index () {
        $categories = Category::all();
        $ads = Ad::where('type','1')->get();
        $offers = Ad::where('type','2')->take(5)->get();
        return response()->json(['data' => ['ads'=>new AdResource($ads),
            'offers'=> new AdResource($offers),'categories' => new CategoryResource($categories)]]);
    }
}
