<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemPriceController extends Controller
{
    public function index () {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:ads,id',
        ]);

        $data = Item::select('price')->where('id',request()->id)->first();
        return response()->json(['data' => $data]);
    }
}
