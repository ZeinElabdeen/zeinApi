<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ClassificationCollection;
use App\Models\Brand;
use Validator;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function show ($id) {
        Validator::make(['id' => $id],
            [
                'id' => ['required','integer', 'exists:brands,id'],
            ])->validate();
        $data = Brand::findOrFail($id);
//return $data;
        return response()->json(['data' => new ClassificationCollection($data->classifications),]);

    }
}
