<?php

namespace App\Http\Controllers\Api;

use App\Models\Vendor;
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
                'lat'=> ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'lng'=> ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'items' => 'required|array',
                //'vendor' => 'required|integer|exists:vendors,id',
            ]);


            $order_items = request()->items;
            $order_vendors  = array();
            $order_items_new = array();
            foreach ($order_items as &$item) {

                $item_data = Item::findOrFail( $item['id'] );
                $item['price'] = $item_data->price;
                $item['discount'] = $item_data->discount;
                $item['vendor_id'] = $item_data->vendor_id;
                if (!in_array($item_data->vendor_id, $order_vendors))
                {
                  $order_vendors[] = $item_data->vendor_id;
                }
                $order_items_new[] = $item;
            }

            foreach ($order_vendors as $vendor) {
              $orderCost = 0;
              $order_inputs['user_id'] = auth('api')->id();
              $order_inputs['vendor_id'] = $vendor;
              $order_inputs['code'] = $this->randToken();
              $order_inputs['lat'] = request()->lat;
              $order_inputs['lng'] = request()->lng;
              $create_order = Order::create($order_inputs);

              if (!$create_order) {
                  return response()->json(['message' => trans('response.failed')],444);
              }

              foreach ($order_items_new as $item) {

                if( $item['vendor_id'] == $vendor ):

                  $inputs['order_id'] = $create_order->id;
                  $inputs['item_id'] = $item['id'];
                  $inputs['count'] = $item['count'];
                  $inputs['discount'] = $item['discount'];

                    if( $item['discount'] > 0 ):
                      $inputs['price'] = $item['price'] - $item['price']*( $item['discount']/100 );
                    else:
                      $inputs['price'] = $item['price'];
                    endif;

                  $createItems = OrderItems::create($inputs);
                  if (!$createItems) {
                      Order::find($inputs['order_id'])->delete();
                      return response()->json(['message' => trans('response.failed')],444);
                  }

                  // update order cost
                  $orderCost = $orderCost + ($createItems->price * $createItems->count);

                endif;
              }

              $create_order->update([
                  'order_cost' => $orderCost,
                  'total_cost' => $orderCost,
              ]);

            }

        return response()->json(['message' => trans('collection.order.store')],200);

      }

    // public function storeold () {
    //
    //     $this->validate(request(),
    //         [
    //             'lat'=> ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
    //             'lng'=> ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
    //             'items' => 'required|array',
    //             //'vendor' => 'required|integer|exists:vendors,id',
    //         ]);
    //
    //         dd(request()->items);
    //     $orderCost = 0;
    //
    //     // get delivery price value from database
    //     $vendor = Vendor::findOrFail(request()->vendor);
    //     $deliveryCost = $vendor->delivery_cost;
    //
    //         // prepare inputs to be stored
    //     $inputs['user_id'] = auth('api')->id();
    //     $inputs['vendor_id'] = request()->vendor;
    //     $inputs['code'] = $this->randToken();
    //     $inputs['delivery_cost'] = $deliveryCost;
    //     $inputs['lat'] = request()->lat;
    //     $inputs['lng'] = request()->lng;
    //
    //     $create = Order::create($inputs);
    //     if (!$create) {
    //         return response()->json(['message' => trans('response.failed')],444);
    //     }
    //     // add order items
    //     foreach (request()->items as $item) {
    //         $itemPrice = $this->itemPrice($item['id']);
    //
    //         $inputs['order_id'] = $create->id;
    //         $inputs['item_id'] = $item['id'];
    //         $inputs['count'] = $item['count'];
    //         $inputs['price'] = $itemPrice;
    //         $createItems = OrderItems::create($inputs);
    //         if (!$createItems) {
    //             Order::find($inputs['order_id'])->delete();
    //             return response()->json(['message' => trans('response.failed')],444);
    //         }
    //
    //         // update order cost
    //         $orderCost = $orderCost + ($createItems->price * $createItems->count);
    //     }
    //
    //     // update order to set order cost, total order cost.
    //     $totalCost = $orderCost + $deliveryCost;
    //     $create->update([
    //         'order_cost' => $orderCost,
    //         'total_cost' => $totalCost,
    //     ]);
    //
    //     return response()->json(['message' => trans('collection.order.store')],200);
    //   }

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
}
