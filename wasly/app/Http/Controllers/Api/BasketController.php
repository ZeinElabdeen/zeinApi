<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VillagesCollection;
use App\Models\City;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;

class BasketController extends Controller
{
    public function index () {

        Validator::make(request()->all(),[
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:items,id',
        ])->validate();
        $data = array();
        foreach (request()->ids as $id) {
            $data['prices'][] = Item::where('id',$id)->first(['id','price']);
        }
        $data['villages'] = new VillagesCollection(auth('api')->user()->city->villages);
        return response()->json(['data' => $data]);
    }

    public function shippingPrice ($id) {
        Validator::make(['id' => $id],[
            'id' => ['required','integer',Rule::exists('cities','id')->where(function ($query) {
                $query->where('Village','!=','NULL');
            })]
        ])->validate();

        $price = City::findOrFail($id);
        return response()->json(['data' => ['price' => $price->shipping_cost]]);

    }
}
