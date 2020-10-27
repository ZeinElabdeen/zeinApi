<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\GeneralNotificationCollection;
use Validator;
use App\Http\Controllers\Controller;

class NotificationController extends ResponseController
{
    public function status ($status) {
        Validator::make(['status' => $status],
            [
                'status' => 'required|integer|in:0,1',
            ])->validate();
        $this->user->notification = $status;
        $this->user->save();
        return $this->apiResponse(['message' => trans('collection.status.success')],200);
    }

    public function index () {
        $data = $this->user->notifications ;
        return response()->json(['data' => new GeneralNotificationCollection($data)]);
    }
}
