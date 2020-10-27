<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemRatesCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\Rate;
use Validator;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function show ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:items,id'],
            ])->validate();
        $data = Item::findOrFail($id);
//return $data;
        return response()->json(['data' => new ItemResource($data),]);

    }

    public function itemRates ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:items,id'],
            ])->validate();
        $data = Item::findOrFail($id);
        $isRated = $this->isRated($id);
        return response()->json(['data' => [
            'data' => new ItemRatesCollection($data->rates),
            'is_rated' => $isRated,
            'item_rate' => $data->rate,
        ]]);
    }

    public function isRated ($id) {
        $check = Rate::where('user_id' ,auth('api')->id())->where('item_id' ,$id)->first();
        return (!$check) ? false: true;
    }
}
