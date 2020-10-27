<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\VendorResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UserDetailsController extends Controller
{
    public function index () {
        $data = auth('api')->user();
        if ($data->type == '0') {
            return response()->json(['data' => new UserResource($data)]);
        }
        return response()->json(['data' => new VendorResource($data)]);
    }
}
