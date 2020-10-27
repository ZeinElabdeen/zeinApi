<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class BasketController extends Controller
{
    public function index () {
        $this->validate(request(),[
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:items,id',
        ]);
        $data = array();
        foreach (request()->ids as $id) {
            $data['prices'][] = Item::where('id',$id)->first(['id','price']);
        }
        return response()->json(['data' => $data]);

    }
}
