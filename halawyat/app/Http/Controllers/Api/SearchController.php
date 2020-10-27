<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemsCollection;
use App\Models\Item;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index () {
//        dd(request()->all());
        $this->validate(request(),
            [
                'search' => 'required|string|max:255',
            ]);
        $data = Item::where('title_en', 'LIKE', '%' . request()->search . '%')
            ->orWhere('title_ar','LIKE','%'.request()->search,'%')->get();
        return response()->json(['data' => new ItemsCollection($data)]);

    }
}
