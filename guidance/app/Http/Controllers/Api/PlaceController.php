<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\UserPlacesCollection;
use App\Models\UserPlaces;

class PlaceController extends ResponseController
{
    public function store () {
        $this->validate(request(),
            [
                'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            ]);
        $check = UserPlaces::where('user_id',auth('user')->id())
            ->where('lat',request()->lat)->where('lng',request()->lng)->first();
        if ($check) {
            return $this->apiResponse(['message' => trans('collection.favorite.exist')],444);
        }
        $inputs['user_id']  = auth('user')->id();
        $inputs['lat']    = request()->lat;
        $inputs['lng']    = request()->lng;
        $create = UserPlaces::create($inputs);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('collection.favorite.success')],200);

    }

    public function userPlaces () {
        $data = auth('user')->user()->places;
        return new UserPlacesCollection($data);
    }

    public function delete () {
        $this->validate(request(),['id'=>'required|integer|exists:user_places,id']);
        $data = UserPlaces::findOrFail(request()->id);
        $delete = $data->delete();
        if (!$delete) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $favorites = auth('user')->user()->places;
        return $this->apiResponse(['message' => trans('collection.favorite.removed'),
            'data' => new UserPlacesCollection($favorites)],200);
    }
}
