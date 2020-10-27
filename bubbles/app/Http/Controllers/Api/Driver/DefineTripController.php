<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\NewPackagesCollection;
use App\Models\Package;
use App\Models\DeliverRequest;
use Illuminate\Support\Facades\DB;

class DefineTripController extends ResponseController
{
    public function index () {

        $d_id = auth('driver')->user()->id;
        $my_reqs = DeliverRequest::where('driver_id',$d_id)->get('package_id')->toArray();
        $data = Package::where('driver_id',null)->whereNotIn('id', $my_reqs)->where('status','0')->get();

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
