<?php

namespace App\Http\Controllers\Api\User\Vendor;

use App\Http\Controllers\ResponseController;
use App\Models\VendorDetails;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ResponseController
{
    public function register(Request $request)
    {
        // input validation

        $this->validate(request(), [
            'username' => 'required|string|min:3|max:255',
            'phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:users,phone',
            'city' => 'required|integer|max:255|exists:cities,id',
            'category' => 'required|integer|max:255|exists:categories,id',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],

        ]);

        // send email verification with token
//        $rand = User::randToken();
        // prepare inputs
        $data = User::create([
            'username' => $request->username,
            'type' => '1',
            'city_id' => $request->city,
            'category_id' => $request->category,
            'phone' => $request->phone,
            'lng' => $request->lng,
            'lat' => $request->lat,
            'verified' => '55555',
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        VendorDetails::create(['vendor_id' => $data->id,'rate' => 0]);
        return $this->apiResponse(['message' => trans('user.register.success')],200);

    }
}
