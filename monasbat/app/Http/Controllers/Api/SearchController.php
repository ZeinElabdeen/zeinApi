<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\CategoryCollection;
use App\Models\User;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index () {
        $data = User::whereIn('type',['1','2'])->where('username','like','%' .request('search') . '%')->get();
//        return $data;
        return response()->json(['data' => new CategoryCollection($data)]);
    }
}
