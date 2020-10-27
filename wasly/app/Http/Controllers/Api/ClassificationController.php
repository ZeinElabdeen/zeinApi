<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemCollection;
use App\Models\Classification;
use Validator;
use App\Http\Controllers\Controller;

class ClassificationController extends Controller
{
    public function show ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:classifications,id'],
            ])->validate();
        $data = Classification::findOrFail($id);
//return $data;
        return response()->json(['data' => new ItemCollection($data->items),]);

    }
}
