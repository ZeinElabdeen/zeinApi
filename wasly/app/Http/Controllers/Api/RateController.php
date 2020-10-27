<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\ItemRatesCollection;
use App\Models\Item;
use App\Models\Rate;
use Illuminate\Validation\Rule;
use Validator;
class RateController extends ResponseController
{
    public function store () {
        Validator::make(request()->all(),
            [
                'id'      => ['required','integer',Rule::exists('items')],
                'rate'    => 'required|numeric',
                'review'    => 'required|string',

            ])->validate();
        $check = Rate::where('user_id',auth('api')->id())->where('item_id',request()->id)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
        }
        $item = Item::find(request()->id);

        $create = Rate::create([
            'user_id'   => auth('api')->id(),
            'item_id'   => request()->id,
            'rate'      => request()->rate,
            'review'      => request()->review,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $item->rate = ($item->rate == 0)? request()->rate : ($item->rate + request()->rate) / 2 ;
        $item->save();
        return $this->apiResponse(['message' => trans('collection.rate.success')],200);
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
