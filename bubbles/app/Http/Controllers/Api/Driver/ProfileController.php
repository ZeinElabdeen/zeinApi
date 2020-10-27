<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\DriverResource;
use Validator;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Controller;

class ProfileController extends ResponseController
{
    public function get () {
        $data = auth('driver')->user();
        return response()->json(['data' => new DriverResource($data)]);
    }

    public function post () {
        $this->validate(request(), [
            'username' => 'nullable|string|min:3|max:191',
            //'phone'    => 'nullable|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:users,phone,'.auth('driver')->id(),
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'driving_license'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = auth('driver')->user();

        if (request()->hasFile('image')){
            $this->updateImage(request()->file('image'),'image');
        }

        if (request()->hasFile('driving_license')){
            $this->updateImage(request()->file('driving_license'),'driving_license');
        }
        $inputs = [
            'username' => request()->username == null ? $user->username : request()->username,
            'email'   => request()->email == null ? $user->email : request()->email,
          //  'phone'   => request()->phone == null ? $user->phone : request()->phone,
            'id_number'   => request()->id_number == null ? $user->id_number : request()->id_number,

        ];
        if ($user->update($inputs)){
            return $this->apiResponse(['message' => trans('response.updated')],200);
        }
        return $this->apiResponse(['message' => trans('response.failed')],444);

    }

    public function updateImage ($image,$old) {
        $user = auth('driver')->user();
        $imageName = md5($old.time()). '.'.$image->getClientOriginalExtension();
        $imageMove = $image->move(public_path('uploads/driver'),$imageName);
        if (!$imageMove) {
            return $this->apiResponse(['message' => trans('response.failed_image')],444);
        }
        if ($user->$old != null && file_exists(public_path('uploads/driver/'.$user->$old))) {
            unlink(public_path('uploads/driver/'.$user->$old));
        }
        $user->$old = $imageName;
        $user->save();
        return true;
    }

    public function update_reg_id () {

          $this->validate(request(), [
              'registration_id' => 'required',
          ]);
          $user = auth('driver')->user();
          $inputs = [
              'registration_id' => request()->registration_id,
          ];

          if ($user->update($inputs)){
              return $this->apiResponse(['message' => trans('response.updated')],200);
          }
          return $this->apiResponse(['message' => trans('response.failed')],444);
      }


}
