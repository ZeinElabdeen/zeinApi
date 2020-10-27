<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\UserOrderResource;
use Validator;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    public function index () {
        $data = auth('api')->user()->orders;
        return response()->json(['data' => new UserOrderResource($data)]);
    }
}
