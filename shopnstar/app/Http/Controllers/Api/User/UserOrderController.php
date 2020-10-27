<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\UserOrderResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    public function index ($type='') {
      if($type != '')
      {
        if($type == 'active')
        {
          $data = auth('api')->user()->orders->whereIn('status',[0,1,2]);
        }
        if($type == 'completed')
        {
          $data = auth('api')->user()->orders->whereIn('status',[3,4]);
        }

        }else{
          $data = auth('api')->user()->orders;
        }
        return response()->json(['data' => new UserOrderResource($data)]);
    }
}
