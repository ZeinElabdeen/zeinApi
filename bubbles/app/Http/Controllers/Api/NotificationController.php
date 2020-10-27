<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index () {
        $data = auth('api')->user()->notifications ;

        return response()->json(['data' => new NotificationCollection($data)]);
    }
}
