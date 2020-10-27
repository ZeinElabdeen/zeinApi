<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\VendorResource;
use Validator;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Controller;

class ProfileController extends ResponseController
{
    public function get () {
        $data = auth('vendor')->user();
        return response()->json(['data' => new VendorResource($data)]);
    }

    public function post () {
        Validator::make(['id' => request()->category],
            [
                'id'=> 'nullable|integer|exists:categories,id,parent_id,NULL',

            ],[],['id' => 'category'])->validate();

        $this->validate(request(), [
            'name' => 'nullable|string|min:3|max:191',
            'phone'    => ['nullable','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/','unique:vendors,phone,'.auth('vendor')->id()],
            'email'    => 'nullable|email|unique:users,email|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'delivery_time'=> 'nullable|string',
            'delivery_cost'=> 'nullable|numeric',
            'lat'=> ['nullable','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng'=> ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        $vendor = auth('vendor')->user();

        if (request()->hasFile('image')){
            $this->updateImage(request()->file('image'),'image');
        }

        $inputs = [
            'name' => request()->name == null ? $vendor->name : request()->name,
            'email'   => request()->email == null ? $vendor->email : request()->email,
            'phone'   => request()->phone == null ? $vendor->phone : request()->phone,
            'delivery_time'   => request()->delivery_time == null ? $vendor->delivery_time : request()->delivery_time,
            'delivery_cost'   => request()->delivery_cost == null ? $vendor->delivery_cost : request()->delivery_cost,
            'lat'   => request()->lat == null ? $vendor->lat : request()->lat,
            'lng'   => request()->lng == null ? $vendor->lng : request()->lng,

        ];
        if ($vendor->update($inputs)){
            return $this->apiResponse(['message' => trans('response.updated')],200);
        }
        return $this->apiResponse(['message' => trans('response.failed')],444);

    }

    public function updateImage ($image,$old) {
        $vendor = auth('vendor')->user();
        $imageName = md5($old.time()). '.'.$image->getClientOriginalExtension();
        $imageMove = $image->move(public_path('uploads/vendor'),$imageName);
        if (!$imageMove) {
            return $this->apiResponse(['message' => trans('response.failed_image')],444);
        }
        if ($vendor->$old != null && file_exists(public_path('uploads/vendor/'.$vendor->$old))) {
            unlink(public_path('uploads/vendor/'.$vendor->$old));
        }
        $vendor->$old = $imageName;
        $vendor->save();
        return true;
    }
}
