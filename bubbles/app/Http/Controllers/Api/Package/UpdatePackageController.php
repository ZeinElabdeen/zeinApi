<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\ResponseController;
use App\Models\Attach;
use App\Models\Package;
use Carbon\Carbon;

class UpdatePackageController extends ResponseController
{
    public function index() {
//dd(\request()->all());
        $this->validate(request(),
            [   'id' => 'required|exists:packages,id,user_id,'.auth('api')->id(),
                'start_lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'start_lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'end_lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'end_lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'arriving_date' => 'required|date|after:yesterday',
                'arriving_time' => 'required|date_format:H:i|after:'.Carbon::now()->format('H:i'),
                'id_number' => 'required|string',
                'description' => 'nullable|string',
                'type' => 'required|in:0,1,2',
                'notes' => 'required|in:0,1,2,3,4',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
            ]);
        $package = Package::findOrFail(request()->id);
        $update = $package->update([
            'start_lat' => request()->start_lat,
            'start_lng' => request()->start_lng,
            'end_lat' => request()->end_lat,
            'end_lng' => request()->end_lng,
            'arriving_date' => request()->arriving_date,
            'arriving_time' => request()->arriving_time,
            'id_number' => request()->id_number,
            'description' => request()->description,
            'type' => request()->type,
            'notes' => request()->notes,
            'status' => '0',
            ]);
        if (!$update) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        if (request()->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $index => $image) {
                $imageName = md5($index.time()). '.'.$image->getClientOriginalExtension();
                $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
                if (!$imageMove) {
                    return $this->apiResponse(['message' => trans('response.failed_image')],444);
                }
                Attach::create([
                    'package_id' => request()->id,
                    'image' => $imageName
                ]);
            }
        }
        return $this->apiResponse(['message' => trans('response.updated')],200);
    }
}
