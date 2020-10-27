<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\NewPackagesCollection;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DefineTripController extends ResponseController
{
    public function index () {

        $data = Order::where('driver_id',null)->where('status','0')->get();
            return response()->json(['data' => new NewPackagesCollection($data)]) ;
//        $data = DB::table('users')->select( DB::raw( "*,
//                 (3959 * ACOS(COS(RADIANS($latitude))
//                       * COS(RADIANS(`lat`))
//                       * COS(RADIANS($longitude) - RADIANS(`lng`))
//                       + SIN(RADIANS($latitude))
//                       * SIN(RADIANS(`lat`)))) AS distance" )
//
//        )->where('category_id',$id)
//            ->orderBy( 'distance', 'asc' )
//            ->paginate(12);
    }
}
