<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\UserPackagesCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;

class UserPackageController extends Controller
{
    public function index () {
        return response()->json(['data' => new UserPackagesCollection(auth('api')->user()->packages)]) ;
    }

    public function packages_status()
    {
       $user_id = auth('api')->user()->id;
       $packages_req  = Package::where('user_id','=',$user_id)->join('deliver_requests', 'packages.id', '=', 'deliver_requests.package_id')
                                  ->join('drivers', 'deliver_requests.driver_id', '=', 'drivers.id')
                                  ->get(['packages.id AS package_id','packages.status','deliver_requests.driver_id','deliver_requests.cost','drivers.username AS user_name','drivers.image AS user_image','packages.user_id','packages.updated_at'])->toArray();

       $packages_status  = Package::where('user_id','=',$user_id)->join('drivers', 'packages.driver_id', '=', 'drivers.id')
                                  ->get(['packages.id AS package_id','packages.status','packages.driver_id','drivers.username AS user_name','drivers.image AS user_image','packages.user_id','packages.updated_at'])->toArray();

        $all_packages = array_merge($packages_req,$packages_status);

       return response()->json(['data' => $all_packages ]) ;
    }

}
