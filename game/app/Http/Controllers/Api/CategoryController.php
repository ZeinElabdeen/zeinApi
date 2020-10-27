<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoriesCollection;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
      $categories = Category::all();
      return response()->json(['data'=> ['categories' =>new CategoriesCollection($categories)]]);

        }

}
