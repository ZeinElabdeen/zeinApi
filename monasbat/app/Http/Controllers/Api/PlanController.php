<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\PlanResource;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use Carbon\Carbon;

class PlanController extends ResponseController
{
    public function index () {
       
       $data = Plan::all();
      $subscription_end = auth('api')->user()->vendorDetails->subscription_end;
      $subscription_end = Carbon::now()->diffInDays($subscription_end, false);

     return response()->json(['data' => new PlanResource($data),'subscription_end' => $subscription_end]);
    
    }

    public function subscribe () {
        $this->validate(request(),
            [
                'id'    => 'required|integer|exists:plans,id',
                'promocode'    => 'string',
                //'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            ]);

        $user = auth('api')->user();
        /* $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/plan'),$imageName);
        if (!$imageMove) {
            return $this->apiResponse(['message' => trans('response.failed_image')],444);
        }
        // delete old image if exist
        if ($user->vendorDetails->membership_image != null && file_exists(public_path('uploads/plan/'.$user->vendorDetails->membership_image))) {
            unlink(public_path('uploads/plan/'.$user->vendorDetails->membership_image));
        } */

        $plan = Plan::find(request()->id);

        // change user type to be waiting for confirmation
        $user->type = '2';
        $user->save();
       // $user->vendorDetails->subscription_end = Carbon::now()->addMonths($plan->period) ;
        
    if (Carbon::parse($user->vendorDetails->subscription_end)->gt(Carbon::now()) )
      {
        $user->vendorDetails->subscription_end = Carbon::parse($user->vendorDetails->subscription_end)->addDays($plan->period) ;
      }
      else{
        $user->vendorDetails->subscription_end = Carbon::now()->addDays($plan->period) ;
      }

       // $user->vendorDetails->membership_image = $imageName;
        $user->vendorDetails->save();
          if(isset(request()->promocode))
        {
            DB::table('salecodes')->where('code', request()->promocode)->update(['statu' => 0]);
        }
        return $this->apiResponse(['message' => trans('collection.plan.success')],200);
    }
}
