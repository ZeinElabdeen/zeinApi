<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\FavoriteResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;

class UserFavoriteController extends Controller
{
    public function index () {

        $data = Favorite::where('user_id',auth('api')->id())->get();
        return response()->json(['data' => new FavoriteResource($data)]);
    }
}
