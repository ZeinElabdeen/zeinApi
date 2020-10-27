<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Resources\UserPackagesCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverPackageController extends Controller
{
    public function index () {
        return response()->json(['data' => new UserPackagesCollection(auth('driver')->user()->packages)]) ;
    }
}
