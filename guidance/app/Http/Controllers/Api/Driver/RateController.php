<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\RatesCollection;
use App\Models\User;
use App\Models\DriverRate;
use Validator;
class RateController extends ResponseController
{
    public function store () {
//        dd(request()->all());
        Validator::make(request()->all(),
            [
                'id'      => 'required|string|exists:users,id',
                'order_id'      => 'required|numeric|exists:orders,id',
                'rate'    => 'required|numeric',
                'review'    => 'required|string|min:3|max:255',

            ])->validate();
         $check = DriverRate::where('user_id',request()->id)->
                              where('order_id',request()->order_id)->
                              where('driver_id',auth('driver')->id())->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
        }
        $user = User::findOrFail(request()->id);
        $create = DriverRate::create([
            'order_id'   => request()->order_id,
            'user_id'   => request()->id,
            'driver_id'   => auth('driver')->id(),
            'rate'      => request()->rate,
            'review'      => request()->review,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $user->rate = ($user->rate == 0)? request()->rate : ($user->rate + request()->rate) / 2 ;
        $user->save();
        return $this->apiResponse(['message' => trans('collection.rate.success')],200);
    }

    public function driverRates () {
        $data = auth('driver')->user()->driverRated;
        return $this->apiResponse(['data' => new RatesCollection($data)],200);
    }

}
