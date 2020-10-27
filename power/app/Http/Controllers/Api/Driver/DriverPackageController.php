<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Resources\UserOrdersCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverPackageController extends Controller
{
    public function index () {
        return response()->json(['data' => new UserOrdersCollection(auth('driver')->user()->packages)]) ;
    }
}
