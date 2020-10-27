<?php

namespace App\Http\Controllers\Api\User\Vendor;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\VendorResource;
use App\Models\Attach;
use App\Models\VendorDetails;
use Validator;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\Controller;

class ProfileController extends ResponseController
{
    public function updateProfile () {
        $this->validate(request(), [
            'username' => 'nullable|string|min:3|max:191',
            'city'   => 'nullable|integer|max:191',
            'address'   => 'nullable|string|max:255',
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $user = auth('api')->user();
        if (request()->hasFile('image')){
            $image = request()->file('image');
            $imageName = md5(time()). '.'.$image->getClientOriginalExtension();
            $imageMove = $image->move(public_path('uploads/user'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
        }

        $inputs = [
            'username' => request()->username == null ? $user->username : request()->username,
            'city_id' => request()->city == null ? $user->city : request()->city,
            'address' => request()->address == null ? $user->address : request()->address,
            'lng' => request()->lng == null ? $user->lng : request()->lng,
            'lat' => request()->lat == null ? $user->lat : request()->lat,
            'image' => request()->image == null ? $user->image : $imageName,

        ];
        if ($user->update($inputs)){
            return $this->apiResponse(['message' => trans('response.updated')],200);
        }
        return $this->apiResponse(['message' => trans('response.failed')],444);
    }

    public function updateDetails () {
        if (count(request()->all()) <= 0) {
            return $this->apiResponse(['message' => trans('response.no_update_data')],444);
        }

        $this->validate(request(), [
            'description' => 'nullable|string|min:3|max:191',
            'cover_image'   => 'nullable|image|max:5120',
            'whatsapp'   => 'nullable|string|max:255',
            'facebook'   => 'nullable|string|max:255',
            'twitter'   => 'nullable|string|max:255',
            'instagram'   => 'nullable|string|max:255',
            'images' => 'nullable|array',
          //  'images.*' => 'image|max:5120',
          //  'file.*' => 'mimes:jpeg,png,bmp,gif,svg,mp4,qt',
        ]);
// upload attaches vendor gallery if exist
        if (request()->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $index => $image) {
                $imageName = md5(time().$index). '.'.$image->getClientOriginalExtension();
                $file_type = $image->getMimeType();
                $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
                if (!$imageMove) {
                    return $this->apiResponse(['message' => trans('response.failed_image')],444);
                }
                Attach::create([
                    'vendor_id' => auth('api')->id(),
                    'image' => $imageName,
                    'file_type' => $file_type,
                ]);
            }
        }

        $user = auth('api')->user();
// check if user has details or not
        if($user->vendorDetails != null){
            $user = $user->vendorDetails;
            $new = false;
        }
        else {
            $user = new VendorDetails();
            $new = true;
        }
// upload cover image if exists
        if (request()->hasFile('cover_image')) {
            $imageName = 'cover_'.md5(time()). '.'.request()->file('cover_image')->getClientOriginalExtension();
            $imageMove = request()->file('cover_image')->move(public_path('uploads/user'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
            if ($new == false && $user->cover_image != null && file_exists(public_path('uploads/user/'.$user->cover_image))) {
                unlink(public_path('uploads/user/'.$user->cover_image));
            }
        }
        else {
            $imageName = $user->cover_image;
        }
// update rest data
        $user->vendor_id = auth('api')->id();
        $user->description = request()->description == null ? null: request()->description;
        $user->whatsapp = request()->whatsapp == null ? null: request()->whatsapp;
        $user->facebook = request()->facebook == null ? null: request()->facebook;
        $user->twitter = request()->twitter == null ? null: request()->twitter;
        $user->instagram = request()->instagram == null ? null: request()->instagram;
        $user->cover_image = $imageName;

        if ($user->save()){
            return $this->apiResponse(['message' => trans('response.updated')],200);
        }
        return $this->apiResponse(['message' => trans('response.failed')],444);
    }

}
