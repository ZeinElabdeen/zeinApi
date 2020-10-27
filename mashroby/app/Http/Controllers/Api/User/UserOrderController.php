<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\UserOrderResource;
use Validator;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    public function index ($type) {
        // 0 => active orders (status = 0,1,3 new ,confirmed,underway)
        // 1 => previous orders (status = 4 done)
        // 2 => favourite orders
        Validator::make(['type'=>$type],['type' => 'required|integer|in:0,1,2'])->validate();

        switch ($type) {
            case '0':
                $data = auth('api')->user()->activeOrders;
                return response()->json(['data' => new UserOrderResource($data)]);
            case '1':
                $data = auth('api')->user()->previousOrders;
                return response()->json(['data' => new UserOrderResource($data)]);
            case '2':
                $data = auth('api')->user()->favoriteOrders;
             
                return response()->json(['data' => new UserOrderResource($data)]);
        }
    }
}
