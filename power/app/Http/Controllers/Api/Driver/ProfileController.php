<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\DriverResource;
use Validator;
use App\Models\Salecodes;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Controller;

class ProfileController extends ResponseController
{
    public function get () {
        $data = auth('driver')->user();
        return response()->json(['data' => new DriverResource($data)]);
    }

    public function charge_wallet() {

        $this->validate(request(), [
            'charge_code'    => 'required|exists:salecodes,code',
        ]);

        $user = auth('driver')->user();
        $charge_code_data = Salecodes::where('code',request()->charge_code)->first() ;
        if($charge_code_data->statu == '0')
        {
          return $this->apiResponse(['message' => trans('response.code_used')],200);
        }
        else{
            $newwallet = $user->wallet + $charge_code_data->salevalue ;
            if ($user->update(['wallet' =>$newwallet ])){

                $charge_code_data->update(['statu' =>'0']);
                return $this->apiResponse(['message' => trans('response.updated'),'your_balance' => $newwallet ],200);

            }
            return $this->apiResponse(['message' => trans('response.failed')],444);

        }
    }

    public function post () {
        $this->validate(request(), [
            'username' => 'nullable|string|min:3|max:191',
            'phone'    => 'nullable|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:drivers,phone,'.auth('driver')->id(),
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = auth('driver')->user();

        if (request()->hasFile('image')){
            $this->updateImage(request()->file('image'),'image');
        }

        $inputs = [
            'username' => request()->username == null ? $user->username : request()->username,
            'phone'   => request()->phone == null ? $user->phone : request()->phone,

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
}
