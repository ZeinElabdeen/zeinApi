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
          //'registration_id' => ['required','unique:drivers,registration_id'],
            'registration_id' => 'required',
            'id_number' => 'required',
            'username' => 'required|string|min:3|max:255',
            'phone'    => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/','unique:drivers,phone'],
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
        // send verification with token
        $rand = Driver::randToken();
        // prepare inputs
        $data = Driver::create([
            'registration_id' => $request->registration_id,
            'username' => $request->username,
            'phone' => $request->phone,
            'id_number' => $request->id_number,
            'verified' => $rand,
            'image' => $imageName,
            'driving_license' => $drivingLicense,
            'password' => Hash::make($request->get('password')),
        ]);
        if (!$data->save()) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $send_sms = $this->send_code($request->phone,$rand);
        return $this->apiResponse(['message' => trans('user.register.success'),'data'=> ['code' => trans('response.check_verfication_code')]],200);
    }


  private function send_code($phone,$rand)
  {
      $username = '966569532966';
      $password = 'A1234567890a';
      $sender = 'BUBBLES';
      $numbers = $phone;
      $message = $rand;
      $api_url = 'https://www.hisms.ws/api.php?send_sms&username='.$username.'&password='.$password.'&numbers='.$phone.'&sender='.$sender.'&message='.$message;
    //  return $response = file_get_contents($api_url);

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
  }

}
