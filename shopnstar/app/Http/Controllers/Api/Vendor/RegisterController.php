<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\ResponseController;
use Validator;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ResponseController
{
    public function register(Request $request)
    {
        // input validation

      /*  Validator::make(['id' => request()->category],
            [
                'id'=> 'required|integer|exists:categories,id,parent_id,NULL',

            ],[],['id' => 'category'])->validate();*/

        $this->validate(request(), [
            'name' => 'required|string|min:3|max:255',
            'phone'    => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/','unique:vendors,phone','unique:users,phone'],
            'image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'email'    => 'required|email|unique:users,email|max:255',
            'description'=> 'required|string',
            //'delivery_time'=> 'required|string',
            //'delivery_cost'=> 'required|numeric',
            'lat'=> ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng'=> ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        // send verification with token

        // upload image
        if ($request->hasFile('image')) {
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/vendor'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
        }

        // prepare inputs
        $rand = Vendor::randToken();
        $data = Vendor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'lat' => $request->lat,
            'lng' => $request->lng,
            //'category_id' => $request->category,
            'verified' => $rand,
            'image' => $imageName,
            'description' => $request->description,
            'fcm_token' => $request->fcm_token,
            //'delivery_cost' => $request->delivery_cost,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('user.register.success'),'code' => $rand],200);
    }
}
