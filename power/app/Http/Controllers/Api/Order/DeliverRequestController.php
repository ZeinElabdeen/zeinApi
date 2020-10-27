<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\OrderRequestsCollection;
use App\Models\DeliverRequest;
use App\Models\Order;
use Validator;

class DeliverRequestController extends ResponseController
{
    public function makeDeliverRequest() {

        Validator::make(['cost' => request()->cost,'id' => request()->order_id],
            [
                'id'=> 'required|integer|exists:orders,id,status,0',
                'cost' => 'required|integer',

            ],[],['id' => 'order_id'])->validate();

        $checkRequestExist = DeliverRequest::where('driver_id',auth('driver')->id())
            ->where('order_id',request()->order_id)->first();
        if ($checkRequestExist) {
            return $this->apiResponse(['message' => trans('collection.order.exists')],444);
        }

        $create = DeliverRequest::create([
            'order_id' => request()->order_id,
            'driver_id' => auth('driver')->id(),
            'cost' => request()->cost,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.order.make_request')],200);
    }

    public function orderRequests ($id) {
        Validator::make(['id' => $id],
            [
                'id'=> 'required|integer|exists:orders,id,status,0',

            ])->validate();

        $data = DeliverRequest::where('order_id',$id)->orderBy('id','desc')->get();
        return response()->json(['data' => new OrderRequestsCollection($data)]);
    }

    public function deleteRequest () {
        Validator::make(request()->all(),
            [
                'id'=> 'required|integer|exists:deliver_requests,id',

            ])->validate();

        DeliverRequest::destroy(request()->id);
        return response()->json(['data' => ['message' => trans('response.deleted')]]);
    }
}
