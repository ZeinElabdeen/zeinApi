<?php

namespace App\Http\Controllers\Api\Driver;

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
            'service' => 'required|integer|in:0,1',
            'gender' => 'required|integer|in:0,1',
            'car_model' => 'required|integer|exists:cars_models,id',
            'car_type' => 'required|integer|exists:cars_types,id',
            'phone'    => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/','unique:drivers,phone'],
            'email'    => ['required','email','unique:drivers,email'],
            'id_number'    => 'required|string:max:191',
            'car_color'    => 'required|string|max:255',
//            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'id_image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'car_front_image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'car_back_image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'car_form_image'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'driving_license_image'=> 'required|image|mimes:jpg,jpeg,png|max:5120',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

//        $image = $this->uploadImage(request()->image,'driver');
        $car_front_image = $this->uploadImage(request()->car_front_image,'driver');
        $car_back_image = $this->uploadImage(request()->car_back_image,'driver');
        $car_form_image = $this->uploadImage(request()->car_form_image,'driver');
        $driving_license_image = $this->uploadImage(request()->driving_license_image,'driver');
        $id_image = $this->uploadImage(request()->id_image,'driver');
        // prepare inputs
        $data = Driver::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'service' => $request->service,
            'car_model_id' => $request->car_model,
            'car_type_id' => $request->car_type,
            'id_number' => $request->id_number,
            'car_color' => $request->car_color,
            'verified' => 55555,
//            'image' => $image,
            'id_image' => $id_image,
            'car_front_image' => $car_front_image,
            'car_back_image' => $car_back_image,
            'car_form_image' => $car_form_image,
            'driving_license_image' => $driving_license_image,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        return $this->apiResponse(['message' => trans('user.register.success')],200);
    }

    private function uploadImage ($image,$path) {
            $imageName = md5(rand(1000,9999).time()). '.'.$image->getClientOriginalExtension();
            $imageMove = $image->move(public_path('uploads/'.$path),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
            return $imageName;
    }
}
