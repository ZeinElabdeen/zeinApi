<?php

namespace App\Http\Controllers\Api\Driver;

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
        Validator::make(['status' => $status],['status' => 'required|integer|in:1,2'])->validate();

        switch ($status){
            case 1:
            if( !empty($this->user->activeOrder) )
            {
                //  return response()->json(['data' => new DriverDoneOrderResource($this->user->activeOrder)]) ;
                return response()->json(['data' => new DriverOrdersCollection($this->user->activeOrder)]) ;
            } else {
              return response()->json(['data' => [] ]) ;

            }
                break;
            case 2:

              if( !empty($this->user->doneOrders) )
              {
                return response()->json(['data' => new DriverOrdersCollection($this->user->doneOrders)]) ;
              }
                else {
                 return response()->json(['data' => [] ]) ;
               }

            break;
            default:
                return response()->json('',404);
        }

    }
}
