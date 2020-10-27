<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends ResponseController
{
    public function store () {
        $this->validate(request(),
            [
                'id'=>'required|integer|exists:items,id'
            ]);

        $checkExistsFavorite = Favorite::where('user_id',auth('api')->id())
            ->where('item_id',request()->id)->first();

        if ($checkExistsFavorite) {
            return $this->apiResponse(['message' => trans('collection.favorite.exist')],444);
        }

        $inputs['user_id']  = auth('api')->id();
        $inputs['item_id']    = request()->id;

        $create = Favorite::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.success')],200);

    }

    public function delete () {
        $this->validate(request(),['id'=>'required|integer|exists:items,id']);
        $data = Favorite::where('item_id',request()->id)->where('user_id',auth('api')->id())->first();

        if (!$data){
            return $this->apiResponse(['message' => trans('collection.favorite.not_exist')],444);
        }
        $delete = $data->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.removed')],200);
    }

    public function deleteAll () {
        foreach (auth('api')->user()->favorites as $favorite ) {
            $delete = $favorite->delete();
            if (!$delete) {
                return $this->apiResponse(['message' => trans('response.failed')],444);
            }
        }
        return $this->apiResponse(['message' => trans('collection.favorite.removed')],200);
    }
}
