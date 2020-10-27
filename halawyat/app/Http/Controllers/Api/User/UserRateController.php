<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\RatesCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRateController extends Controller
{
    public function index () {
        $data = auth('api')->user()->rates;
        return response()->json(['data' => new RatesCollection($data)]);
    }
}
