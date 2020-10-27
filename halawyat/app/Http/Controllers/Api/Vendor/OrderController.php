<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\UserOrderResource;
use Validator;
use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index () {
        $data = auth('vendor')->user()->orders;
        return response()->json(['data' => new UserOrderResource($data)]);
    }

    public function details ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id'])->validate();
        $data = Order::find($id);
        return response()->json(['data' => new OrderDetailsResource($data)]);
    }

    public function accept ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id,status,0'])->validate();
        $data = Order::find($id);
        $data->status = '1';
        $data->save();
        return response()->json(['message' => trans('collection.order.accepted')],200);
    }

    public function reject ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id,status,0'])->validate();
        $data = Order::find($id);
        $data->status = '2';
        $data->save();
        return response()->json(['message' => trans('collection.order.rejected')],200);
    }

}
