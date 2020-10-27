<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Resources\OrderDetailsResource;
use App\Models\Order;
use Validator;
use App\Http\Controllers\Controller;

class OrderDetailsController extends Controller
{
    public function index ($id) {
        Validator::make(['id' => $id],['id'=> 'required|integer|exists:orders,id'])->validate();
        $data = Order::findOrFail($id);
        return response()->json(['data'=> new OrderDetailsResource($data)]);
    }
}
