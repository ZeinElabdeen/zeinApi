<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\ResponseController;
use App\Models\DeliverRequest;
use App\Models\Package;
use App\Models\Driver;
use App\Models\User;
use App\Models\Chat;
use Validator;

class PackageController extends ResponseController
{
    public function driverController () {
        $this->validate(request(),
            [
                'status' => 'required|integer|in:4,3,2',
                'id' => 'required|integer|exists:packages,id,driver_id,'.auth('driver')->id(),
            ]);
        $package = Package::findOrFail(request()->id);
        $package->status = request()->status;
        (request()->status == 4) ? $package->driver_id = null:false ;
        $save = $package->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        if(request()->status == 4 || request()->status == 3)
        {
          $chat_data = Chat::where('driver_id', '=',$package->driver_id)
              ->where('package_id', '=',request()->id)
              ->first();
          $chat_data->statue = '1' ;
          $chat_data->save();
        }

        $statusnames[0] = trans('response.statu_0');
        $statusnames[1] = trans('response.statu_1');
        $statusnames[2] = trans('response.statu_2');
        $statusnames[3] = trans('response.statu_3');
        $statusnames[4] = trans('response.statu_4');
        $statusnames[5] = trans('response.statu_5');

        $u_registration_id = User::find($package->user_id)->registration_id;
        $msg = 'Check The  Package Deliver Request Driver updated to '.$statusnames[request()->status];
        $title = 'Deliver Request Driver update '.$statusnames[request()->status];
        $this->notifcation(array($u_registration_id),$msg,$title,request()->status,request()->id);

        return $this->apiResponse(['message' => trans('collection.package.change_status')],200);
    }

    public function userController () {
        $this->validate(request(),
            [
                'status' => 'required|integer|in:4',
                'id' => 'required|integer|exists:packages,id,user_id,'.auth('api')->id(),
            ]);
        $package = Package::findOrFail(request()->id);
        $package->status = request()->status;
        //$package->vendor_id = null;
        $save = $package->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        $d_registration_id = Driver::find($package->driver_id)->registration_id;
        $msg = trans('response.request_cancel_mess');
        $title = trans('response.request_cancel_title');
        $this->notifcation(array($d_registration_id),$msg,$title,request()->status,request()->id);

        return $this->apiResponse(['message' => trans('collection.package.change_status')],200);
    }

    public function confirmDriver () {
        Validator::make(['id' => request()->id],['id'=> 'required|integer|exists:packages,id,status,0'])->validate();
        Validator::make(['id' => request()->driver_id],
            ['id'=> 'required|integer|exists:drivers,id'],[],['id' => 'driver_id'])->validate();

        $package = Package::findOrFail(request()->id);
        $package->status = '1';
        $package->driver_id = request()->driver_id;
        $save = $package->save();
        if (!$save) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
        // delete all requests
        $data = DeliverRequest::where('package_id',request()->id)->pluck('id');
        DeliverRequest::destroy($data);
        $driver_registration_id  = Driver::where('id', '=',request()->driver_id)->get()->first()->registration_id;
        $driver_registration_id = array($driver_registration_id);
        $msg = trans('response.request_confirmed_mess');
        $title = trans('response.request_confirmed_title');
        $this->notifcation($driver_registration_id,$msg,$title,'1',request()->id);
        return $this->apiResponse(['message' => trans('collection.package.confirm_driver')],200);
    }

    private function notifcation($registrationIds,$mes_data,$mes_title,$statu,$package_id)
    {
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAvQLYYD0:APA91bHZfD-F17TsloAJz9pV32kLmdg4bXZ_6-EiuRcKgCJruedpeyhaqQ5lPqxFjlHOFFPNGwhAVG6WpD1qv3YvZ5A4NA7vd11riGYfGV8DU97XQ6tOg-CbImFdZQ2VJPfHclsFhQf_');
        //$registrationIds = array($_POST['register_key']);

        // prep the bundle
        $msg = array
        (
        	'message' 	=> $mes_data,
        	'title'		=> $mes_title,
        	'subtitle'	=> $mes_title,
        	'statu'	=> $statu,
        	'package_id'	=> $package_id,
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
                            'statu' => $statu,
                            'title' => $mes_title,
                            'body' => $mes_data
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
