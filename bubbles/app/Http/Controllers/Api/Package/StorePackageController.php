<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\ResponseController;
use App\Models\Attach;
use App\Models\Package;
use App\Models\Driver;
use Carbon\Carbon;

class StorePackageController extends ResponseController
{
    public function index() {

      //dd(\request()->all());
        $this->validate(request(),
            [
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
                'images' => 'required|array',
                'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
            ]);
        $create = Package::create([
            'user_id' => auth('api')->id(),
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
        if (!$create) {
            return $this->apiResponse(['message' => trans('response.failed')],444);
        }
    if (request()->hasFile('images')){
        $images = request()->file('images');
        foreach ($images as $index => $image) {
            $imageName = md5($index.time()). '.'.$image->getClientOriginalExtension();
            $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
            Attach::create([
                'package_id' => $create->id,
                'image' => $imageName
            ]);
        }
      }
      //--------send notifcation to drivers ---------//
        $registrationIds  = Driver::where('registration_id', '!=', '')->get('registration_id')->toArray();
        $registrationIds = array_column($registrationIds, 'registration_id');
        $this->notifcation($registrationIds);
      //---------------             ---------------//
        return $this->apiResponse(['message' => trans('collection.package.store')],200);
    }

  private function notifcation($registrationIds)
  {
      // API access key from Google API's Console
      define( 'API_ACCESS_KEY', 'AAAAvQLYYD0:APA91bHZfD-F17TsloAJz9pV32kLmdg4bXZ_6-EiuRcKgCJruedpeyhaqQ5lPqxFjlHOFFPNGwhAVG6WpD1qv3YvZ5A4NA7vd11riGYfGV8DU97XQ6tOg-CbImFdZQ2VJPfHclsFhQf_');
      //$registrationIds = array($_POST['register_key']);

      // prep the bundle
      $msg = array
      (
      	'message' 	=> trans('response.new_package'),
      	'title'		=> trans('response.new_package'),
      	'subtitle'	=> trans('response.new_package'),
        'type'	=>   1,
      	'vibrate'	=> 1,
      	'sound'		=> 1
      );

      $fields = array
                  (
                      'registration_ids' => $registrationIds,
                      'data' => $msg,
                      'priority' => 'high',
                      'notification' => array(
                          'title' => trans('response.new_package'),
                          'body' => trans('response.new_package')
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


  public function loction_in_rang()
  {

    $Distance = $this->getDistanceFromLatLonInKm(30.044220,31.236120,29.845400,31.337150);
    echo $Distance;
  }

  private function getDistanceFromLatLonInKm($lat1,$lon1,$lat2,$lon2) {
   $R = 6371; // Radius of the earth in km
   $dLat = deg2rad($lat2-$lat1);  // deg2rad below
   $dLon = deg2rad($lon2-$lon1);
   $a =
    sin($dLat/2) * sin($dLat/2) +
    cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
    sin($dLon/2) * sin($dLon/2)
    ;
   $c = 2 *  atan2(sqrt($a), sqrt(1-$a));
   $d = $R * $c; // Distance in km
  return  $d;
}

private function deg2rad($deg) {
  return $deg * (pi()/180);
}


}
