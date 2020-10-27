<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\ResponseController;
use Validator;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ResponseController
{
    public function register(Request $request)
    {
        // input validation

        $this->validate(request(), [
            'username' => 'required|string|min:3|max:255',
            'phone'    => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:drivers,phone',
            'image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'driving_license'=> 'required|image|mimes:jpg,jpeg,png|max:5120',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        // send verification with token

        // upload image
        if ($request->hasFile('image')) {
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/driver'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
        }

        // upload driving license image
        if ($request->hasFile('driving_license')) {
            $drivingLicense = 'driving_license_'.md5(time()). '.'.request()->file('driving_license')->getClientOriginalExtension();
            $imageMove = request()->file('driving_license')->move(public_path('uploads/driver'),$drivingLicense);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
        }
        // prepare inputs
        $data = Driver::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'verified' => 55555,
            'image' => $imageName,
            'driving_license' => $drivingLicense,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('user.register.success')],200);
    }
}
