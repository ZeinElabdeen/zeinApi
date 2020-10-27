<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Resources\UserPackagesCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;

class DriverPackageController extends Controller
{
    public function index () {
        return response()->json(['data' => new UserPackagesCollection(auth('driver')->user()->packages)]) ;
    }

    public function packages_status()
    {
       $driver_id = auth('driver')->user()->id;
       $packages_status  = Package::where('driver_id','=',$driver_id)->join('users', 'packages.user_id', '=', 'users.id')
                                  ->get(['packages.id AS package_id','packages.status','packages.driver_id','packages.user_id','users.username AS user_name','users.image AS user_image','packages.updated_at'])->toArray();
       return response()->json(['data' => $packages_status ]) ;
    }
}
