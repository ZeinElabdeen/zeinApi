<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Resources\PackageDetailsResource;
use App\Models\Package;
use Validator;
use App\Http\Controllers\Controller;

class PackageDetailsController extends Controller
{
    public function index ($id) {
        Validator::make(['id' => $id],['id'=> 'required|integer|exists:packages,id'])->validate();
        $data = Package::findOrFail($id);
        return response()->json(['data'=> new PackageDetailsResource($data)]);
    }
}
