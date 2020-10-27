<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function index () {
        $offers = Item::where('type','2')->get();
        return response()->json(['data' => new AdResource($offers)]);
    }
}
