<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Models\Favorite;
use Illuminate\Validation\Rule;

class FavoriteController extends ResponseController
{
    public function store () {
        $this->validate(request(),['id'=>['required','integer',Rule::exists('users')->where(function ($query){
            $query->where('type','!=','0');
        })]]);
        $inputs['user_id']  = auth('api')->id();
        $inputs['vendor_id']  = request()->id;
        $checkExists = Favorite::where('user_id',auth('api')->id())->where('vendor_id',request()->id)->first();
        if ($checkExists){
            return $this->apiResponse(['message' => trans('collection.favorite.exist')],444);
        }
        $create = Favorite::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.success')],200);

    }

    public function delete () {
        // validate check exists vendor_id in users table
        $this->validate(request(),['id'=>['required','integer',Rule::exists('users')
            ->where(function ($query){
                $query->where('type','!=','0');
            })
            ],]);

        // validate check exists vendor_id in favorites table
//        $val =$this->validate(request(),[request()->id,'vendor_id'],['vendor_id' => 'exists:favorites,vendor_id'
//        ]);
        $data = Favorite::where('user_id',auth('api')->id())->where('vendor_id',request()->id)->first();
        if (!$data){
            return $this->apiResponse(['message' => trans('collection.favorite.not_exist')],444);
        }
        $delete = $data->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.removed')],200);
    }
}
