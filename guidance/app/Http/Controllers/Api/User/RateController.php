<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\RatesCollection;
use App\Models\Driver;
use App\Models\UserRate;
use Validator;
class RateController extends ResponseController
{
    public function store () {
//        dd(request()->all());
        Validator::make(request()->all(),
            [
                'id'      => 'required|string|exists:drivers,id',
                'order_id'      => 'required|numeric|exists:orders,id',
                'rate'    => 'required|numeric',
                'review'    => 'required|string|min:3|max:255',

            ])->validate();
         $check = UserRate::where('user_id',auth('user')->id())->
                            where('order_id',request()->order_id)->
                            where('driver_id',request()->id)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
        }
        $driver = Driver::findOrFail(request()->id);
        $create = UserRate::create([
            'order_id'   => request()->order_id,
            'user_id'   => auth('user')->id(),
            'driver_id'   => request()->id,
            'rate'      => request()->rate,
            'review'      => request()->review,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $driver->rate = ($driver->rate == 0)? request()->rate : ($driver->rate + request()->rate) / 2 ;
        $driver->save();
        return $this->apiResponse(['message' => trans('collection.rate.success')],200);
    }

    public function userRates () {
        $data = auth('user')->user()->userRated;
        return $this->apiResponse(['data' => new RatesCollection($data)],200);
    }

}
