<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function index () {
        $offers = Ad::where('type','2')->get();
        return response()->json(['data' => new AdResource($offers)]);
    }
}
