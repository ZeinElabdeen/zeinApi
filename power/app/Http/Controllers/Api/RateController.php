<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Driver;
use App\Models\Rate;
use Validator;
class RateController extends ResponseController
{
    public function store () {
//        dd(request()->all());
        Validator::make(request()->all(),
            [
                'id'      => 'required|string|exists:drivers,id',
                'rate'    => 'required|integer|in:1,2,3,4,5',
                'review'    => 'required|string|min:3|max:255',

            ])->validate();
        $check = Rate::where('user_id',auth('api')->id())->where('driver_id',request()->id)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
        }
        $driver = Driver::find(request()->id);
        $create = Rate::create([
            'user_id'   => auth('api')->id(),
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

}
