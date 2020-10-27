<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends ResponseController
{
    public function store () {
        //type 0 => item favorite, 1 => order favorite
        $this->validate(request(),['type'=>'required|string|in:0,1']);
        if (request()->type == '0') {
            $this->validate(request(),['id'=>'required|integer|exists:ads,id']);
            $checkExist = Favorite::where('user_id',auth('api')->id())->where('ad_id',request()->id)->first();
            if ($checkExist) {
                return $this->apiResponse(['message' => trans('collection.favorite.exist')],444);
            }
            $inputs['user_id']  = auth('api')->id();
            $inputs['ad_id']    = request()->id;
        }
        else {
            $this->validate(request(),['id'=>'required|integer|exists:orders,id']);
            $checkExist = Favorite::where('user_id',auth('api')->id())->where('order_id',request()->id)->first();
            if ($checkExist) {
                return $this->apiResponse(['message' => trans('collection.favorite.exist')],444);
            }
            $inputs['user_id']  = auth('api')->id();
            $inputs['order_id']    = request()->id;
        }
        $create = Favorite::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.success')],200);

    }

    public function delete () {
        
        if(isset(request()->type) && request()->type == 'item')
        {
          $this->validate(request(),['id'=>'required|integer|exists:favorites,ad_id','type' => 'required|string']);
          $data = Favorite::where('ad_id',request()->id);
        }else{
          $this->validate(request(),['id'=>'required|integer|exists:favorites,id']);
          $data = Favorite::find(request()->id);
        }
        
        $delete = $data->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.removed')],200);
    }
}
