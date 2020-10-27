<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
 
use App\Http\Controllers\Controller;

class SalecodesController extends Controller
{
    public function promo_code ($code) {
        $data = DB::table('salecodes')->where('code', $code)->first();
       return response()->json(['code' => $data->code,'codevalue' => $data->salevalue,'statu' => $data->statu]);
      //  return response()->json($data);
    }
}
