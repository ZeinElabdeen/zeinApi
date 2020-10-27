<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\City;
use App\Models\Item;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderItems;
use Illuminate\Validation\Rule;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\ResponseController;

class OrderController extends ResponseController
{
    public function store () {

        $this->validate(request(),
            [
                'village' => ['required','integer',Rule::exists('cities','id')->where(function ($query) {
                    $query->where('shipping_cost','!=','NULL');
                })],
                'address_description' => 'required|string',
                'coupon' => 'nullable|exists:coupons,code',
                'items' => 'required|array',
            ]);

        // get coupon details
        if (request()->coupon != null) {
            $coupon = $this->couponDetails(request()->coupon);
            if(!empty($coupon))
            {
            //  $couponDetails['id'] = $coupon->id;
              $couponDetails['code'] = $coupon->code;
              $couponDetails['discount'] = $coupon->discount;
            }else{
              $couponDetails['code'] = null;
              $couponDetails['discount'] = null;
            }
        }
        else {
            $couponDetails['code'] = null;
            $couponDetails['discount'] = null;
        }
        $orderCost = 0;
        $discount = 0;

        // get shipping price value from database
        $sippingCost = City::sippingPrice(request()->village);

        // prepare inputs to be stored
        $inputs['user_id'] = auth('api')->id();
        $inputs['code'] = $this->randToken();
        $inputs['coupon'] = $couponDetails['code'];
        $inputs['coupon_discount'] = $couponDetails['discount'];
        $inputs['shipping_cost'] = $sippingCost;
        $inputs['village_id'] = request()->village;
        $inputs['address_description'] = request()->address_description;

        $create = Order::create($inputs);
        if (!$create) {
            return response()->json(['message' => trans('response.failed')],444);
        }

     if(!empty($coupon)){
          $state = Coupon::where('code',$couponDetails['code'])->first();
          $state->status = '0';
          $state->save();
        }

        // add order items
        foreach (request()->items as $item) {
            $itemPrice = $this->itemPrice($item['id']);

            $inputs['order_id'] = $create->id;
            $inputs['item_id'] = $item['id'];
            $inputs['count'] = $item['count'];
            $inputs['price'] = $itemPrice;
            $createItems = OrderItems::create($inputs);
            if (!$createItems) {
                Order::find($inputs['order_id'])->delete();
                return response()->json(['message' => trans('response.failed')],444);
            }

            // update order cost
            $orderCost = $orderCost + ($createItems->price * $createItems->count);
        }

        if ($create->coupon != null){
            $discount = ($orderCost * $couponDetails['discount']) / 100;
        }
        // update order to set order cost, total order cost.
        $totalCost = $orderCost + $sippingCost - $discount;
        $create->update([
            'order_cost' => $orderCost,
            'total_cost' => $totalCost,
        ]);

        // update user points
        return response()->json(['message' => trans('collection.order.success')],200);

      }

    public function show ($id) {
        Validator::make(['id' => $id],['id' => 'required|integer|exists:orders,id'])->validate();
        $data = Order::find($id);
        return response()->json(['data' => new OrderResource($data)]);
    }

    public function delete ()
    {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:orders,id',
        ]);
        $order = Order::findOrFail(request()->id);
        $delete = $order->delete();
        if (!$delete) {
            return response()->json(['message' => trans('response.failed')],444);
        }
        foreach ($order->orderItems as $item) {
            $item->delete();
        }
        return response()->json(['message' => trans('response.deleted')],200);

    }

    protected function randToken () {
        $token = rand(1000000,9999999);
        return (Order::where('code',$token)->first())?$this->randToken():$token;

    }

    protected function itemPrice ($id) {
        $item = Item::findOrFail($id);
        return $item->price;
    }

    protected function couponDetails ($code) {
        return Coupon::where('code',$code)->where('status','1')->first(['code','discount']);
    }
}
