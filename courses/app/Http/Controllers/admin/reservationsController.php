<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\reservationsModel;
use Exeption;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirmationMail;

class reservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prev = 0;
        if($request->has('prev')){
            if($request->input('prev') == 'yes'){
                $prev = 1;
            }else{
                return redirect()->back();
            }
            
        }
        $reserve = reservationsModel::allReservation();
        $lastReservation = reservationsModel::lastReservation();
        return view('admin.reservation.allReservation',[
            'reserve'=>$reserve,
            'lastReserve' => $lastReservation,
            'prev'=>$prev,
        ]);
        // $allReservations = reservationsModel::getAllReservations();
        // return view('admin.reservations.allReservations',[
        //     'allReservations' => $allReservations
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = reservationsModel::allStudents();
        $courses = reservationsModel::allCourses();
        return view('admin.reservation.addReservation',[
            'students'=>$students,
            'courses'=>$courses,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                "living_id"             =>"required|numeric|exists:living",
                "medical_insurance_id"  =>"required|numeric|exists:medical_insurance",
                "airport_rec_id"            =>"required|numeric|exists:airport_rec",
        ]);
        if($request->coupon != null){
            $data['coupon_number']=$request->coupon;
            $valid = Validator::make($data,[
                'coupon_number'=>'exists:coupons'
            ]);
            if($valid->fails()){
                return redirect()->back()->with('Error','Wrong Coupon');
            }
        }
        $data['living_id']= $request->living_id;
        $data['medical_insurance_id']= $request->medical_insurance_id;
        $data['airport_rec_id']= $request->airport_rec_id;
        $data['student_id'] = Session()->get('reservationArr')['student_id'];
        $data['course_id'] = Session()->get('reservationArr')['course_id'];
        $data['start_at'] = Session()->get('reservationArr')['start_at'];
        $data['reserved_weeks_number'] = Session()->get('reservationArr')['reserved_weeks_number'];
        reservationsModel::addReservation($data);
        Session()->forget('reservationArr');

        return  redirect('admin/reservation')->with('Success','You have Successfully add reserevation ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id,$mark = null)
    {
        if($mark){
            reservationsModel::markNoti($id);
        }
       
        $reservationDetails = reservationsModel::getReservationDetails($id);
        $students = reservationsModel::getAllST();
        $courses = reservationsModel::getAllCourses();

        $residences = reservationsModel::getCourseResidences($reservationDetails->course_id);
        $insurances =reservationsModel::getCourseInsurances($reservationDetails->course_id);
        $receptions = reservationsModel::getCourseReceptions($reservationDetails->course_id);
        // return $residences;

        return view('admin.reservation.reservationDetails',[

            'reservationDetails'=>$reservationDetails,
            'students'=>$students,
            'courses'=>$courses,

            'residences'=>$residences,
            'insurances'=>$insurances,
            'receptions'=>$receptions,


        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id'             => 'required|numeric|exists:courses',
            'student_id'            => 'required|numeric|exists:students',
            'living_id'             => 'required|numeric|exists:living',
            'airport_rec_id'        => 'required|numeric|exists:airport_rec',
            'medical_insurance_id'  => 'required|numeric|exists:medical_insurance',
            'start_at'              => 'required|date',//|after_or_equal:today
            'reserved_weeks_number' => 'required|numeric',
            // 'coupon'                => 'numeric|exists:coupon',

        ]);
        $reservationData = $request->except('_token','_method');

        // if($request->has('coupon')){
        //     if(is_null($request->coupon)){
        //         $reservationData['coupon'] = null;
        //     }
        // }
        // echo('<pre><br>'); print_r($reservationData); echo('<pre><br>');return 'ok';
        $reservation = reservationsModel::insertReservation($id,$reservationData);
        return redirect()->back()->with('Success','Successfully updated');
        // return redirect()->back()->with('Error',' Please Try Again ! ');

        // echo('<pre><br>'); print_r($request->all()); echo('<pre><br>');return 'ok';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        reservationsModel::deleteRservation($id);
        return redirect()->back();
    }


    public function allConfirmReservation()
    {
        $reverve = reservationsModel::allConfirmedReservation();
        return view('admin.reservation.confirmReservation',[
            'reserve'=>$reverve
        ]);
    }
    public function allCancelReservation()
    {
        $cancel = reservationsModel::allCanceledReservation();
        return view('admin.reservation.cancelReservation',[
            'cancel'=>$cancel
        ]);
    }

    public function statusConfirm($id)
    {
        $reservation_id = $id;
        $reservationData = reservationsModel::getReservationData($reservation_id);
        $student_data = reservationsModel::getStudentData($reservationData->student_id);
                // dump($student_data->fcm_token);return 'ok';

        $lang = '_ar';
        if($student_data->mob_lang == 'ar'){
            $lang = '_ar';
        }else{
            $lang = '';
        }

        // notification content data 
        $content = [];
        $content['title_ar'] = 'تأكيد الحجز';
        $content['details_ar'] = $reservation_id.' تم الموافقة على الحجز رقم ';
        $content['title'] = 'reservation confirmation';
        $content['details'] = 'Reservation No. '.$reservation_id.' has been approved';
        

        
        

        // return $result;
        if(reservationsModel::confirmStatus($reservation_id)){
            reservationsModel::updateTitle($reservation_id,$content);
            $result = $this->senNotificationToSingleUser($student_data->fcm_token, $content['title'.$lang],$content['details'.$lang],$reservation_id);
            
            $resrvDetails = reservationsModel::getReserveMail($reservationData->student_id,$reservation_id);
            $resrvDetails->course_name                = $resrvDetails->{'course_name'.$lang};
            $resrvDetails->institute_name             = $resrvDetails->{'institute_name'.$lang};
            $resrvDetails->living_name                = $resrvDetails->{'living_name'.$lang};
            $resrvDetails->country                    = $resrvDetails->{'country'.$lang};
            $resrvDetails->city_name                    = $resrvDetails->{'city_name'.$lang};


            $website = reservationsModel::getWebsite();
            $socialMedia = reservationsModel::getSocial();

            $logo = reservationsModel::getLogo();
            $logoPath = 'storage/images/logo/';
            $fullPath = public_path($logoPath.$logo);
            $res = Mail::to($resrvDetails->student_email)->send(new confirmationMail($resrvDetails,$lang,$website,$socialMedia,$fullPath));
            if ($res == null){
                    
                return redirect()->back()->with('Success','You have confirmed reservation number: '.$reservation_id);

            }
            return redirect()->back()->with('Error','Please Try Again');


        }else{
            return redirect()->back()->with('Error','please try again');

        }
    }

    public function statusCancel($id)
    {

        $reservation_id = $id;
        $STID = reservationsModel::getSTID($reservation_id);
        
        $FCMToken = reservationsModel::getFCM($STID);
        $title = 'Cancelled reservation';
        $desc = 'Reservation No. '.$reservation_id.' has been cancelled, for more information please contact with us';
        $result = $this->senNotificationToSingleUser($FCMToken, $title, $desc,$reservation_id);

        reservationsModel::cancelStatus($id);
        return redirect()->back();
    }

    private function senNotificationToSingleUser($FCMToken, $title, $desc, $reservation_id)
    {

        define('API_ACCESS_KEY', 'AAAA_PZ10F8:APA91bGUoVQxwTb_KQfD-lxbvKWRhMNNX9OFCHL4pRAPQ02mMyHfT3uFaej8xqYIU6GzFK93y8h0iVrG4pDkS3NmOL0t3ILvqWP-zADXHzGhBnSOAaLWoFLVpxBKGS46yAGWFQoa79TN');
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg = array
                        (
            'body'  => $desc,
            'title'     => $title,
            'reservation_id'=>$reservation_id,
            'vibrate'   => 1,
            'sound'     => 1,
            );
        $fields = array(
            'to' => $FCMToken,
            'data' => $msg,
            'notification' => $msg,
           
        );
        $headers = array(
            'Authorization: key='.API_ACCESS_KEY,
            'Content-type: Application/json'
        );
        try{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        } catch(Exeption $e){
            return $e ;
        }

        return $result ;
    }

    public function reservattionSession(Request $request)
    {
        $request->validate([
            'student_id'=>'required|numeric|exists:students',
            'course_id'=>'required|numeric|exists:courses',
            'start_at'=>'required|after_or_equal:today|date',
            'reserved_weeks_number'=>'required|numeric|min:1'

        ]);
        $data['student_id'] = $request->student_id;
        $data['course_id'] = $request->course_id;
        $data['start_at'] = $request->start_at;
        $data['reserved_weeks_number'] = $request->reserved_weeks_number;

        Session()->put('reservationArr',$data);
        return redirect('admin/add-reservation/'.$data['course_id']);
    }
    public function reservationCourseDetails($course_id)
    {
        if(Session()->get('reservationArr')['course_id'] == $course_id){
            $residences = reservationsModel::allLiving($course_id);
            $insurances = reservationsModel::allInsurances($course_id);
            $receptions = reservationsModel::allReceptions($course_id);

            return view('admin.reservation.addReservation2',[
                'residences'=>$residences,
                'insurances'=>$insurances,
                'receptions'=>$receptions,
            ]);
        }
        return redirect()->back();
    }
}
