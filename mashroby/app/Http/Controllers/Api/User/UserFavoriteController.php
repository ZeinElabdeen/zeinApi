<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;

class UserFavoriteController extends Controller
{
    public function index () {
        $data = auth('api')->user()->favoriteItems;
        return response()->json(['data' => new FavoriteResource($data)]);
    }
}
