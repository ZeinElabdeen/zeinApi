<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VendorResource;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class VendorDetailsController extends Controller
{
    public function index ($id) {
        Validator::make([request()->all(),'id'=>$id],['id'=>['required','integer',Rule::exists('users')->where(function ($query){
            $query->where('type','!=',0);
            })]
        ])->validate();
        $data = User::findOrFail($id);
        return response()->json(['data' => new VendorResource($data)]);
    }
}
