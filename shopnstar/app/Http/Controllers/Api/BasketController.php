<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FavoriteResource;
use App\Http\Controllers\ResponseController;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Basket;

class BasketController extends ResponseController
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

    public function all () {

        $data = Basket::where('user_id',auth('api')->id())->get();
        return response()->json(['data' => new FavoriteResource($data)]);
    }

    public function store () {
        $this->validate(request(),
            [
                'id'=>'required|integer|exists:items,id'
            ]);

        $checkExistsBasket = Basket::where('user_id',auth('api')->id())
            ->where('item_id',request()->id)->first();

        if ($checkExistsBasket) {
            return $this->apiResponse(['message' => trans('collection.basket.exist')],444);
        }

        $inputs['user_id']  = auth('api')->id();
        $inputs['item_id']    = request()->id;

        $create = Basket::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.basket.success')],200);

    }

    public function delete () {

        $this->validate(request(),['id'=>'required|integer|exists:items,id']);
        $data = Basket::where('item_id',request()->id)->where('user_id',auth('api')->id())->first();

        if (!$data){
            return $this->apiResponse(['message' => trans('collection.basket.not_exist')],444);
        }
        $delete = $data->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.basket.removed')],200);

    }

}
