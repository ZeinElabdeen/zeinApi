<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\UserOrderResource;
use Validator;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index ($type='') {

      if($type != '')
      {
        if($type == 'active')
        {
          $data = auth('vendor')->user()->orders->whereIn('status',[0,1,2]);
        }
        if($type == 'completed')
        {
          $data = auth('vendor')->user()->orders->whereIn('status',[3,4]);
        }

      }else{
        $data = auth('vendor')->user()->orders;
      }
        return response()->json(['data' => new UserOrderResource($data)]);
    }

    public function bills ($type) {

        Validator::make(['type' => $type],['type' => 'required|string|in:day,month,year'])->validate();

      if($type != '')
      {
        if($type == 'day')
        {
          $data = Order::where('vendor_id',auth('vendor')->user()->id)
                       ->where('status','4')
                       ->whereDate('updated_at', Carbon::today())
                       ->get();

        }

        if($type == 'month')
        {
          $data = Order::where('vendor_id',auth('vendor')->user()->id)
                       ->where('status','4')
                       ->whereMonth('updated_at', '=', date('m'))
                       ->get();
        }

        if($type == 'year')
        {
          $data = Order::where('vendor_id',auth('vendor')->user()->id)
                       ->where('status','4')
                       ->whereYear('updated_at', '=', date('Y'))
                       ->get();
        }

        return response()->json(['data' => new UserOrderResource($data)]);
      }
    }

    public function details ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id'])->validate();
        $data = Order::find($id);
        return response()->json(['data' => new OrderDetailsResource($data)]);
    }

    public function accept ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id,status,0,vendor_id,'.auth('vendor')->id()])->validate();
        $data = Order::find($id);
        $data->status = '1';
        $data->save();

        $data1['tokens'][] = User::find($data->user_id)->fcm_token;
        $data1['data']['message']   = 'تم قبول طلبك رقم # ' . $data->code;
        $data1['data']['vendor_id'] = auth('vendor')->user()->id;
        $data1['data']['order_id']  = $id;
        parent::send_notifcation($data1);

        return response()->json(['message' => trans('collection.order.accepted')],200);
    }

    public function shipping ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id,status,1,vendor_id,'.auth('vendor')->id()])->validate();
        $data = Order::find($id);
        $data->status = '2';
        $data->save();

        $data1['tokens'][] = User::find($data->user_id)->fcm_token;
        $data1['data']['message']   = 'تم شحن طلبك رقم # ' . $data->code;
        $data1['data']['vendor_id'] = auth('vendor')->user()->id;
        $data1['data']['order_id']  = $id;
        parent::send_notifcation($data1);

        return response()->json(['message' => trans('collection.order.shipping')],200);
    }

    public function delivered ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id,status,2,vendor_id,'.auth('vendor')->id()])->validate();
        $data = Order::find($id);
        $data->status = '4';
        $data->save();

        $data1['tokens'][] = User::find($data->user_id)->fcm_token;
        $data1['data']['message']   = 'تم تسليم طلبك رقم #' . $data->code;
        $data1['data']['vendor_id'] = auth('vendor')->user()->id;
        $data1['data']['order_id']  = $id;
        parent::send_notifcation($data1);

        return response()->json(['message' => trans('collection.order.delivered')],200);
    }

    public function reject () {

        Validator::make(request()->all(), [
          'order_id' => 'required|integer|exists:orders,id,status,0,vendor_id,'.auth('vendor')->id(),
          'reject_reason' => 'required|integer|in:1,2,3,4'
        ])->validate();

        $data = Order::find(request()->order_id);
        $data->status = '3';
        $data->reject_reason = request()->reject_reason;
        $data->save();

        $data1['tokens'][] = User::find($data->user_id)->fcm_token;
        $data1['data']['message']   = 'تم رفض طلبك رقم # ' . $data->code .' سبب الرفض : ' . $data->reject_reason;
        $data1['data']['vendor_id'] = auth('vendor')->user()->id;
        $data1['data']['order_id']  = request()->order_id;
        parent::send_notifcation($data1);

        return response()->json(['message' => trans('collection.order.rejected')],200);
    }

}
