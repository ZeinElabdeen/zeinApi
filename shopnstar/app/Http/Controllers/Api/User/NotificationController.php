<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\NotificationCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index () {
        $data = auth('api')->user()->userNotifications ;
        return response()->json(['data' => new NotificationCollection($data)]);
    }
}
