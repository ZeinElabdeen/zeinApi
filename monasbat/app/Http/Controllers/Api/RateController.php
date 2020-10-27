<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\User;
use App\Models\Rate;
use Illuminate\Validation\Rule;
use Validator;
class RateController extends ResponseController
{
    public function index () {
        Validator::make(request()->all(),
            [
                'id'      => ['required','integer',Rule::exists('users')->where(function ($query){
                    $query->where('type','!=','0');
                })],
                'rate'    => 'required|integer|in:1,2,3,4,5',
                'review'    => 'nullable|string',

            ],[],['id' => 'vendor'])->validate();
        $check = Rate::where('user_id',auth('api')->id())->where('vendor_id',request()->id)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
        }
        $user = User::find(request()->id);

        $create = Rate::create([
            'user_id'   => auth('api')->id(),
            'vendor_id'   => request()->id,
            'rate'      => request()->rate,
            'review'      => request()->review,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $user->vendorDetails->rate = ($user->vendorDetails->rate == 0)? request()->rate : ($user->vendorDetails->rate + request()->rate) / 2 ;
        $user->vendorDetails->save();
        return $this->apiResponse(['message' => trans('collection.rate.success')],200);
    }

}
