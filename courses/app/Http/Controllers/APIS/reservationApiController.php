<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\APIS\reservationApiModel;
use App\APIS\authApiModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\sentInvoice;
use App\Mail\sendInvoiceInst;
use Illuminate\Support\Facades\URL;
use PDF;

class reservationApiController extends Controller
{


    public function reserve(Request $request)
    {
        // return $request->all();
        // $access_token = $request->header('access_token');
        // $STID = Session()->get($access_token);
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $lang = parent::detectLang($request);

        if($lang = "_ar"){
            $valid = validator::make($request->all(),[
                "id"                    =>"required|numeric",
                // "living_id"             =>"numeric",
                // "medical_insurance_id"  =>"numeric",
                // "airport_id"            =>"numeric",
                "start_date"            =>"required|after_or_equal:today|date",
                "weeks_number"          =>"required|numeric",
                "coupon_number"         =>"exists:coupons",
                "student_passport_name" =>"required|max:50",
                "student_passport_number"=>"required|numeric|unique:students",
                "passport_photo"        =>"required|image",
            ],[
                "start_date.required" =>"يجب ادخال تاريخ بدء الدورة",
                "start_date.after_or_equal" =>"يجب ادخال تاريخ صحيح",
                "coupon_number.exists" =>"هذا الكوبون غير صحيح",
                "student_passport_name.required" =>"يجب ادخال الاسم ",
                "student_passport_name.max" =>"يجب الا يزيد الاسم عن 50 حرف",
                "student_passport_number.required" =>"يجب ادخال رقم جواز السفر",
                "student_passport_number.unique" =>"هذا الرقم تم ادخاله من قبل",
                "student_passport_number.numeric" =>"يجب ان يحتوي علي ارقام فقط",
                "passport_photo.required" =>"يجب ادخال صوره جواز السفر ",
                "passport_photo.image" =>"هذا الملف غير صحيح",
            ]);
        }else{
            $valid = validator::make($request->all(),[
                "id"                    =>"required|numeric",
                // "living_id"             =>"numeric",
                // "medical_insurance_id"  =>"numeric",
                // "airport_id"            =>"numeric",
                "start_date"            =>"required|after_or_equal:today|date",
                "weeks_number"          =>"required|numeric",
                "coupon_number"         =>"numeric|exists:coupons",
                "student_passport_name" =>"required|max:50",
                "student_passport_number"=>"required|numeric|unique:students",
                "passport_photo"        =>"required|image",
            ]);
        }
        
        if($valid->fails()){
            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                foreach($vs as $val)
                {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);
                    
                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }


        $file_name= time().'.'.$request->passport_photo->extension();
        $path=$request->passport_photo->move(storage_path('App\public\images\passports'), $file_name);
        $photoURL =url('storage\App\public\images\passports'.$file_name);


        
        $reservation = new reservationApiModel;
        $reservation->course_id = $request->id;
        
        $reservation->living_id = $request->living_id;

        // default valuse 
        if($request->living_id == null){
            $reservation->living_id  = 4;
            
        }
        $reservation->airport_rec_id = $request->airport_id;
        if($request->airport_id == null){
            $reservation->airport_rec_id = 13;
        }
        $reservation->medical_insurance_id = $request->medical_insurance_id;
        if($request->medical_insurance_id == null){
            $reservation->medical_insurance_id = 13;

        }


        $reservation->start_at = $request->start_date;
        $reservation->reserved_weeks_number = $request->weeks_number;

        $reservation->student_id = $STID;

        if($request->has('coupon_number')){
            $reservation->coupon = $request->coupon_number;
        }else{
            $reservation->coupon_number = null;
        }

        $reservation->passport_photo = $file_name;
        $reservation->student_passport_name = $request->student_passport_name;
        $reservation->student_passport_number = $request->student_passport_number;
        // return $reservation;
        if(reservationApiModel::updatePassport($reservation)){

            if(reservationApiModel::reserve($reservation)){
                
                // return $result;
                return response()->json(['success'=>true,'result' =>(object)[]],200);

            }
            if($lang == '_ar'){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"يرجي اعاده المحاولة ","details"=>array()]],500);

            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }
        if($lang == '_ar'){
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"يرجي اعاده المحاولة ","details"=>array()]],500);

        }
        return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);



    }

    
    public function CurrentReservations(Request $request)
    {
        // $access_token = $request->header('access_token');
        // $STID = Session()->get($access_token);
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $lang = parent::detectLang($request);
        if($lang == "_ar"){
            Carbon::setLocale('ar');
        }
        if($resrve = reservationApiModel::mycurrentReservation($STID)){

            $currentRecord = [];
            $totalCurrentRecords=[];
            $currentPagination = [];
            // return $resrve;
            if($resrve->isEmpty()){
                if($lang == "_ar"){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد  حجوزات حالية  ","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No CURRENT bookings","details"=>array()]],401);

            }
            
            $photo_path =  URL::to('/').'/storage/images/courses/';
            foreach ($resrve as $key => $value) {

               
                    $currentRecord = [
                        "reservation_id"            =>intval($value->reservation_id),
                        "course_name"               =>$value->{'course_name'.$lang},
                        "course_details"            =>$value->{'course_details'.$lang},
                        "reservation_price"         =>$value->total,
                        "course_photo"              =>$photo_path.$value->course_photo,
                        "from"                      =>Carbon::parse($value->created_at)->diffForHumans()
                    ];
                    array_push($totalCurrentRecords,$currentRecord);
     
                
                $currentPagination = [

                    "current_page"      =>$resrve->currentPage(),
                    "next_page_url"     =>$resrve->nextPageUrl(),
                    "pervious_page_url" =>$resrve->previousPageUrl(),
                    "total_records"     =>$resrve->total(),
                    "per_page"          =>$resrve->perPage(),
                    "last_item"         =>$resrve->lastItem(),
                    "last_page"         =>$resrve->lastPage(),

                    ];
                
             }
             if($currentPagination == null){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
            }

             
            return response()->json(['success'=>true,'result' =>['reservations'=>$totalCurrentRecords,"pagination"=>$currentPagination]],200);
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }
    }

    public function LastReservation(Request $request)
    {
        // $access_token = $request->header('access_token');
        // $STID = Session()->get($access_token);
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $lang = parent::detectLang($request);
        if($lang == "_ar"){
            Carbon::setLocale('ar');
        }
        $totalLasttRecords=[];
        $lastRecord = [];
        if($lastReserve = reservationApiModel::mylastReservation($STID)){

            if($lastReserve->isEmpty()){
                if($lang == "_ar"){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد  حجوزات سابقة   ","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No Previous bookings ","details"=>array()]],401);

            }
            $photo_path =  URL::to('/').'/storage/images/courses/';
            foreach ($lastReserve as $key => $value) {
                $lastRecord = [
                    "reservation_id"            =>intval($value->reservation_id),
                    "course_name"               =>$value->{'course_name'.$lang},
                    "course_details"            =>$value->{'course_details'.$lang},
                    "reservation_price"         =>$value->total,
                    "course_photo"              =>$photo_path.$value->course_photo,
                    "from"                      =>Carbon::parse($value->created_at)->diffForHumans()
                ];
                array_push($totalLasttRecords,$lastRecord);
                $lastPagination = [
 
                    "current_page"      =>$lastReserve->currentPage(),
                    "next_page_url"     =>$lastReserve->nextPageUrl(),
                    "pervious_page_url" =>$lastReserve->previousPageUrl(),
                    "total_records"     =>$lastReserve->total(),
                    "per_page"          =>$lastReserve->perPage(),
                    "last_item"         =>$lastReserve->lastItem(),
                    "last_page"         =>$lastReserve->lastPage(),
 
                    ];
            }
            return response()->json(['success'=>true,'result' =>['reservations'=>$totalLasttRecords,"pagination"=>$lastPagination]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }
        
       //  ,'last_reservations'=>$totalLasttRecords,"last_pagination"=>$lastPagination
    }


    public function reservationsDetails(Request $request)
    {

        $lang = parent::detectLang($request);

        // $access_token = $request->header('access_token');
        // $STID = Session()->get($access_token);
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $photo_path = URL::to('/').'/storage/images/courses/';


        if($resrvDetails = reservationApiModel::reservDetails($request->reservation_id,$STID)){

            

            // $record = [];
            $totalrecords=[];
            foreach ($resrvDetails as $key => $value) {

                $totalrecords = [
                        "reservation_id"            =>intval($value->reservation_id),
                        "course_photo"              =>$photo_path.$value->course_photo,
                        "course_name"               =>$value->{'course_name'.$lang},
                        "start_date"                =>$value->start_at,
                        "institute"                 =>$value->{'institute_name'.$lang},
                        "living"                    =>$value->{'living_name'.$lang},
                        "living_price"              =>$value->living_price,
                        "ariport_rec"               =>$value->{'airport_rec_name'.$lang},
                        "living_rec_price"          =>$value->airport_rec_price,
                        "medical_insurance"         =>$value->{'medical_insurance_name'.$lang},
                        "medical_insurance_price"   =>$value->medical_insurance_price,
                        "week_price"                =>$value->week_price,
                        "register_fees"             =>$value->registration_fees,
                        "residence_fees"            =>$value->living_fees,
                        "carier_fees"               =>$value->airport_rec_price,
                        "extra_fees_in_summer"      =>$value->summer_fees,
                        "book_fees"                 =>$value->book_fees,
                        "vat"                       =>$value->tax_fees,
                        // "houseing_price"            =>$value->housing_price,
                        // "reception_price"           =>$value->reception_price,
                        // "insurance_price"           =>$value->insurance_price,
                        "weeks_number"              =>$value->weeks_number,
                        "total"                     =>$value->total

                ];
                // array_push($totalrecords,$record);
             }
            return response()->json(['success'=>true,'result' =>['Reservation_details'=>$totalrecords]],200);
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
            }

    }


    public function SendInvoice(Request $request)
    {

        // $access_token = $request->header('access_token');
        // $STID = Session()->get($access_token);
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $lang = parent::detectLang($request);

        if($resrvDetails = reservationApiModel::getReserveMail($STID,$request->reservation_id)){
            $resrvDetails->course_name                = $resrvDetails->{'course_name'.$lang};
            $resrvDetails->institute_name             = $resrvDetails->{'institute_name'.$lang};
            $resrvDetails->living_name                = $resrvDetails->{'living_name'.$lang};
            $resrvDetails->country                    = $resrvDetails->{'country'.$lang};
            $resrvDetails->city_name                    = $resrvDetails->{'city_name'.$lang};

            $website = reservationApiModel::getWebsite();
            $socialMedia = reservationApiModel::getSocial();
            

            $logo = reservationApiModel::getLogo();
            $logoPath = 'storage/images/logo/';
            $fullPath = public_path($logoPath.$logo);
            
            $url =  URL::to('/');
            $studentPDF = PDF::loadView('user.ar.pdf.PDFbody', compact('logo','resrvDetails','lang' ,'url', 'website'));
            $institutePDF = PDF::loadView('user.ar.pdf.PDFbodyInstitute', compact('logo','resrvDetails','lang' ,'url' , 'website'));
            
            $res = Mail::to($resrvDetails->student_email)->send(new sentInvoice($studentPDF->output(),$resrvDetails,$lang,$website,$socialMedia,$fullPath));

                if ($res == null){
                        $res2 = Mail::to($resrvDetails->institute_email)->send(new sendInvoiceInst($institutePDF->output(),$resrvDetails,$lang,$website,$socialMedia,$fullPath));
                        if ($res2 == null){
                            return response()->json(['success'=>true,'result' =>(object)[]],200);
                            }
                        if($lang = '_ar'){
                            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"يرجي اعادة المحاوله","details"=>array()]],500);
                        }
                        return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again later ","details"=>array()]],500);
                }

        }else{
            if($lang = '_ar'){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"يرجي اعادة المحاوله","details"=>array()]],500);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
            }

        
    }


}
