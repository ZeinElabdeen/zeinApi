<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Carbon\Carbon;

class PlanController extends ResponseController
{
    public function index () {
        $data = Plan::all();
        return response()->json(['data' => new PlanResource($data)]);
    }

    public function subscribe () {
        $this->validate(request(),
            [
                'id'    => 'required|integer|exists:plans,id',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            ]);

        $user = auth('api')->user();
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/plan'),$imageName);
        if (!$imageMove) {
            return $this->apiResponse(['message' => trans('response.failed_image')],444);
        }
        // delete old image if exist
        if ($user->vendorDetails->membership_image != null && file_exists(public_path('uploads/plan/'.$user->vendorDetails->membership_image))) {
            unlink(public_path('uploads/plan/'.$user->vendorDetails->membership_image));
        }

        $plan = Plan::find(request()->id);

        // change user type to be waiting for confirmation
        $user->type = '2';
        $user->save();
        $user->vendorDetails->subscription_end = Carbon::now()->addMonths($plan->period) ;
        $user->vendorDetails->membership_image = $imageName;
        $user->vendorDetails->save();
        return $this->apiResponse(['message' => trans('collection.plan.success')],200);
    }
}
