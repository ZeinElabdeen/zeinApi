<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\Setting;
use Validator;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Coupon;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\ResponseController;

class OrderController extends ResponseController
{
    public function store () {
        $this->validate(request(),
            [
                'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'payment_method' => 'required|integer|in:1,2,3,4,5',
//                'order_cost' => 'required|integer',
//                'total_cost' => 'required|integer',
                'address' => 'required|string',
                'delivery_date' => 'required|integer|in:1,2,3',
                'repeat' => 'required|integer|in:1,2,3',
                'items' => 'required|array',
            ]);
        $itemsCount = count(request()->items);
        $orderCost = 0;

        // get tax value from database
        $tax = Setting::setting('tax');

        // get tax value from database
        $itemPoint = Setting::setting('item_point');

        // prepare inputs to be stored
        $inputs['user_id'] = auth('api')->id();
        $inputs['code'] = $this->randToken();
        $inputs['lng'] = request()->lng;
        $inputs['lat'] = request()->lat;
        $inputs['address'] = request()->address;
        $inputs['payment_method'] = request()->payment_method;
      //  $inputs['promo_code'] = request()->promo_code;
        $inputs['order_creation_date'] = date('Y-d-m');
        $inputs['delivery_date'] = request()->delivery_date;
        $inputs['repeat'] = request()->repeat;

        if ( isset(request()->promo_code) ) {
            $coupon = $this->couponDetails(request()->promo_code);
            if(!empty($coupon))
            {
              $inputs['promo_code'] = $coupon->code;
              $inputs['promo_code_value'] = $coupon->discount;
            }
        }

        $create = Order::create($inputs);
        if (!$create) {
            return response()->json(['message' => trans('response.failed')],444);
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
            // update ad stock
            $this->updateStock($item['id'],$item['count']);

            // update order cost
            $orderCost = $orderCost + ($createItems->price * $createItems->count);
        }
        // update order to set order cost, total order cost, tax value.
        $tax = $orderCost * ($tax / 100);
        if(!empty($coupon))
        {
          $totalCost = $orderCost + $tax - ($orderCost * ($coupon->discount / 100) ) ;
      //  $totalCost = ( $orderCost - ($orderCost * ($coupon->discount / 100) ) ) + $tax ;
          $state = Coupon::where('code',$coupon->code)->first();
          $state->status = '0';
          $state->save();

        }else{
          $totalCost = $orderCost + $tax;
        }
        $from_wallet = 0;
        $cash_req =$totalCost;
        if(auth('api')->user()->wallet > 0)
        {
          $from_wallet = auth('api')->user()->wallet;
          $cash_req = $cash_req - $from_wallet;
        }
        $create->update([
            'order_cost' => $orderCost,
            'total_cost' => $totalCost,
            'tax'        => $tax,
            'from_wallet'=> $from_wallet,
            'cash_req'   => $cash_req,
        ]);

        // update user points

        auth('api')->user()->points = auth('api')->user()->points + ($itemsCount * $itemPoint);
        auth('api')->user()->wallet = 0;
        auth('api')->user()->save();

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

    public function confirm ()
    {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:orders,id',
        ]);
        $order = Order::findOrFail(request()->id);
        $order->status = '4';
        $save = $order->save();
        if (!$save) {
            return response()->json(['message' => trans('response.failed')],444);
        }
        return response()->json(['message' => trans('collection.order.confirm')],200);

    }

    protected function randToken () {
        $token = rand(1000000,9999999);
        return (Order::where('code',$token)->first())?$this->randToken():$token;

    }

    protected function itemPrice ($id) {
        $item = Ad::findOrFail($id);
        return $item->price;
    }

    protected function updateStock ($id,$count) {
        $ad = Ad::where('id',$id)->first();
        $ad->stock = $ad->stock - $count;
        $save = $ad->save();
        return ($save)? true : false;
    }

    protected function couponDetails ($code) {
        return Coupon::where('code',$code)->where('status','1')->first(['code','discount']);
    }

}
