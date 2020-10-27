<?php

namespace App\Http\Controllers\Api\Driver;
use App\Models\DeliverRequest;
use App\Models\Setting;
use App\Models\Order;
use App\Http\Resources\DriverDoneOrderResource;
use App\Http\Resources\DriverOrdersCollection;
use Validator;
use App\Http\Controllers\Controller;

class DriverOrderController extends Controller
{
    public function __construct()
    {
        parent::__construct('driver');
    }

    public function index ($status) {
        Validator::make(['status' => $status],['status' => 'required|integer|in:0,1,2'])->validate();

        switch ($status){

          case 0:
          if(!empty($this->user->wattingOrder)){
              return response()->json(['data' => [new DriverDoneOrderResource($this->user->wattingOrder)]]) ;
            }else {
                return response()->json(['data' => []]) ;
            }
              break;

            case 1:
            if(!empty($this->user->activeOrder)){
                return response()->json(['data' => [new DriverDoneOrderResource($this->user->activeOrder)]]) ;
              }else {
                  return response()->json(['data' => []]) ;
              }
                break;
            case 2:
                return response()->json(['data' => new DriverOrdersCollection($this->user->doneOrders)]) ;
            break;
            default:
                return response()->json('',404);
        }

    }

   public function accept_trip()
   {
     $this->validate(request(),
         [
             'order_id' => 'required|integer|exists:orders,id,status,0',
             'distanc_to_start' => 'required|numeric',
         ]);

         if( $this->user->trip_id == request()->order_id &&  $this->user->has_trip == '3' )
         {

           $checkRequestExist = DeliverRequest::where('driver_id',$this->user->id)
               ->where('order_id',request()->order_id)->first();
           if ($checkRequestExist) {
               return response()->json(['message' => trans('collection.order.exists')],444);
           }

          $rate_percent = Setting::where('key','rate_percent')->first()->value_en;
          $order_cost = Order::findOrFail(request()->order_id)->cost;
          $percent_value = $order_cost * ($rate_percent/100);

          if($percent_value > $this->user->wallet)
          {
             return response()->json(['message' => trans('response.not_enough_money')],444);
          }
           $create = DeliverRequest::create([
               'order_id' => request()->order_id,
               'driver_id' =>  $this->user->id,
               'distanc_to_start' => request()->distanc_to_start,
           ]);
           if (!$create) {
               return response()->json(['message' => trans('response.failed')],444);
           }

           $this->user->has_trip = '2' ;
           $this->user->trip_id = request()->order_id ;
           $this->user->save();
           return response()->json(['message' => trans('response.trip_accepted')],200) ;
         }else{
           return response()->json(['message' => trans('response.driver_not_free')],200) ;
         }

   }

  public function reject_trip()
  {

    $this->validate(request(),
        [
            'order_id' => 'required|integer|exists:orders,id,status,0'
        ]);


      if( $this->user->trip_id == request()->order_id && $this->user->has_trip == '3')
      {
        $this->user->has_trip = '0' ;
        $this->user->trip_id = '' ;
        $this->user->save();
        return response()->json(['message' => trans('response.trip_rejected')],200) ;
      }else{
        return response()->json(['message' => trans('response.trip_driver_not_assigned')],200) ;
      }

  }


}
