<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index () {
        $notifications = auth('api')->user()->userNotifications;
        return response()->json(['data' => new NotificationCollection($notifications)]);
    }
}
