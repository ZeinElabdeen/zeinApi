<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class BasketController extends Controller
{
    public function index () {
        $this->validate(request(),[
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:ads,id',
        ]);
        $data = array();
        foreach (request()->ids as $id) {
            $itemdata = Ad::where('id',$id)->first();
            if(!empty($itemdata->discount))
            {
              $price = $itemdata->price - ( $itemdata->price * $itemdata->discount/100 );
            }
            else{
              $price = $itemdata->price ;
            }
            $data['prices'][]  = array('id' => $itemdata->id, 'price' =>$price, 'price_befor_discount' =>$itemdata->price, 'stock' =>$itemdata->stock);
        }
        $data['tax'] = Setting::setting('tax');
        return response()->json(['data' => $data]);

    }
}
