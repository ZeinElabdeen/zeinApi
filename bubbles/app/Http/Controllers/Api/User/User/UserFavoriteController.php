<?php

namespace App\Http\Controllers\Api\User\User;

use App\Http\Resources\FavoriteResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFavoriteController extends Controller
{
    public function index () {
        $data = auth('api')->user()->favorites;
        return response()->json(['data' => new FavoriteResource($data)]);
    }
}
