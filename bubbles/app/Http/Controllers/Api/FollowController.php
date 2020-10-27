<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\UserFollowsCollection;
use App\Models\Follow;

class FollowController extends ResponseController
{
    public function store () {
        $this->validate(request(),['id'=>'required|integer|exists:clubs,id']);
        $check = Follow::where('user_id',auth('api')->id())->where('club_id',request()->id)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.follow.exist')],444);
        }
        $inputs['user_id']  = auth('api')->id();
        $inputs['club_id']    = request()->id;
        $create = Follow::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.follow.success')],200);

    }

    public function userFollows () {
        $data = auth('api')->user()->follows;
        return new UserFollowsCollection($data);
    }

    public function delete () {
        $this->validate(request(),['id'=>'required|integer|exists:clubs,id']);
        $data = Follow::where([
            ['user_id', '=', auth('api')->id() ],
            ['club_id','=',request()->id]
        ])->first();
//        $data = Follow::find(request()->id);
        $delete = $data->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $follows = $this->userFollows();
        return $this->apiResponse(['message' => trans('collection.follow.removed'),'data' => $follows],200);
    }
}
