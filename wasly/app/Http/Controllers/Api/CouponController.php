<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index () {

        $this->validate(request(),[
            'code'  => 'required|exists:coupons,code',
        ]);

        $data = Coupon::select('discount')
                      ->where('code',request()->code)
                    //  ->where('status','1')
                      ->first();

        return response()->json(['data' => $data]);
    }
}
