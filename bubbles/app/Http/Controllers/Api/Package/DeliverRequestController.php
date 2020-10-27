<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\PackageRequestsCollection;
use App\Models\DeliverRequest;
use App\Models\Package;
use App\Models\User;
use Validator;

class DeliverRequestController extends ResponseController
{
    public function makeDeliverRequest() {

        Validator::make(['cost' => request()->cost,'id' => request()->package_id],
            [
                'id'=> 'required|integer|exists:packages,id,status,0',
                'cost' => 'required|integer',

            ],[],['id' => 'package_id'])->validate();

        $checkRequestExist = DeliverRequest::where('driver_id',auth('driver')->id())
            ->where('package_id',request()->package_id)->first();
        if ($checkRequestExist) {
            return $this->apiResponse(['message' => trans('collection.package.exists')],444);
        }

        $create = DeliverRequest::create([
            'package_id' => request()->package_id,
            'driver_id' => auth('driver')->id(),
            'cost' => request()->cost,
        ]);
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $user_id  = Package::where('id', '=', request()->package_id)->get()->first()->user_id;
        $user_registration_id  = User::where('id', '=',$user_id)->get()->first()->registration_id;
        $user_registration_id = array($user_registration_id);
        $this->notifcation($user_registration_id);
        return $this->apiResponse(['message' => trans('collection.package.make_request')],200);
    }

    public function packageRequests ($id) {
        Validator::make(['id' => $id],
            [
                'id'=> 'required|integer|exists:packages,id,status,0',

            ])->validate();

        $data = DeliverRequest::where('package_id',$id)->orderBy('id','desc')->get();
        return response()->json(['data' => new PackageRequestsCollection($data)]);
    }

    public function deleteRequest () {
        Validator::make(request()->all(),
            [
                'id'=> 'required|integer|exists:deliver_requests,id',

            ])->validate();

        DeliverRequest::destroy(request()->id);
        return response()->json(['data' => ['message' => trans('response.deleted')]]);
    }

    private function notifcation($registrationIds)
    {
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAvQLYYD0:APA91bHZfD-F17TsloAJz9pV32kLmdg4bXZ_6-EiuRcKgCJruedpeyhaqQ5lPqxFjlHOFFPNGwhAVG6WpD1qv3YvZ5A4NA7vd11riGYfGV8DU97XQ6tOg-CbImFdZQ2VJPfHclsFhQf_');
        //$registrationIds = array($_POST['register_key']);

        // prep the bundle
        $msg = array
        (
        	'message' 	=> trans('response.driver_request_mess'),
        	'title'		=> trans('response.driver_request_title'),
        	'subtitle'	=> trans('response.driver_request_title'),
          'type'	  => 1,
        	'vibrate'	=> 1,
        	'sound'		=> 1
        );

        $fields = array
                    (
                        'registration_ids' => $registrationIds,
                        'data' => $msg,
                        'priority' => 'high',
                        'notification' => array(
                            'title' => trans('response.driver_request_mess'),
                            'body' => trans('response.driver_request_title')
                        )
                    );

        $headers = array
        (
        	'Authorization: key=' . API_ACCESS_KEY,
        	'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        //echo $result;

    }

}
