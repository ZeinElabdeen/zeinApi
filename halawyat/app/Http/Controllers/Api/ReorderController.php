<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Order;

class ReorderController extends ResponseController
{
    public function index () {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:orders,id',
        ]);
        $order = Order::findOrFail(request()->id);
        $order->status = '0';
        $save = $order->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.order.reorder')],200);
    }
}
