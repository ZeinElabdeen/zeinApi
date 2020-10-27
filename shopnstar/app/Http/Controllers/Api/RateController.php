<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\ItemRatesCollection;
use App\Models\Vendor;
use App\Models\Rate;
use App\Models\RateItem;
use Illuminate\Validation\Rule;
use Validator;
class RateController extends ResponseController
{
    public function store () {
        Validator::make(request()->all(),
            [
                'id'      => ['required','integer',Rule::exists('vendors')],
                'rate'    => 'required|numeric',
                'review'    => 'required|string',

            ])->validate();
        $check = Rate::where('user_id',auth('api')->id())->where('vendor_id',request()->id)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
        }
        $vendor = Vendor::find(request()->id);

        $create = Rate::create([
            'user_id'   => auth('api')->id(),
            'vendor_id'   => request()->id,
            'rate'      => request()->rate,
            'review'      => request()->review,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $vendor->rate = ($vendor->rate == 0)? request()->rate : ($vendor->rate + request()->rate) / 2 ;
        $vendor->save();
        return $this->apiResponse(['message' => trans('collection.rate.success')],200);
    }

    public function itemRates ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:vendors,id'],
            ])->validate();
        $data = Vendor::findOrFail($id);
        $isRated = $this->isRated($id);
        return response()->json(['data' => [
            'data' => new ItemRatesCollection($data->rates),
            'is_rated' => $isRated,
            'item_rate' => $data->rate,
        ]]);
    }

    public function isRated ($id) {
        $check = Rate::where('user_id' ,auth('api')->id())->where('vendor_id' ,$id)->first();
        return (!$check) ? false: true;
    }


    public function store_rate_item () {

      Validator::make(request()->all(),
          [
              'id'      => 'required|integer|exists:items,id',
              'rate'    => 'required|numeric',
              'review'    => 'required|string',

          ])->validate();

      $check = RateItem::where('user_id',auth('api')->id())->where('item_id',request()->id)->first();
      if ($check) {
          return $this->apiResponse(['message' => trans('collection.rate.exist')],444);
      }

      $create = RateItem::create([
          'user_id'   => auth('api')->id(),
          'item_id'   => request()->id,
          'rate'      => request()->rate,
          'review'      => request()->review,
      ]);
      if (!$create) {
          return $this->apiResponse(['message' => trans('response.failed')],444);
      }

      return $this->apiResponse(['message' => trans('collection.rate.success')],200);
    }

}
