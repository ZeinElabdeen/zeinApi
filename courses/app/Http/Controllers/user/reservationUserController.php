<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user\reservationUserModel;
use App\models\user\authUserModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\sentInvoice;
use App\Mail\sendInvoiceInst;

use Illuminate\Support\Facades\URL;
use PDF;
class reservationUserController extends Controller
{

    public function addReservation(Request $request,$course_id)
    {
        // return $request->all();
        $lang = parent::detectUserLang();
        $STID = Session()->get('user_id');
        $data['airport_rec_id'] = $request->reception;
        $data['living_id'] = $request->residence;
        $data['medical_insurance_id'] = $request->insurance;
        $data['start_at'] = $request->startDate;
        $data['reserved_weeks_number'] = $request->weeksNumber;
        $data['student_id'] = $STID;
        $data['course_id'] = $course_id;


        if($request->coupon != null){
            $data['coupon_number'] = $request->coupon;
        }
        // return $data;

        if($lang == "_ar"){
            $valid = validator::make($data,[
                "living_id"             =>"numeric|exists:living",
                "medical_insurance_id"  =>"numeric|exists:medical_insurance",
                "airport_id"            =>"numeric|exists:airport_rec",
                "start_at"              =>"required|after_or_equal:today|date",
                "reserved_weeks_number" =>"required|numeric",
                "coupon_number"         =>"exists:coupons",
                
            ],[
                "start_at.required" =>"يجب ادخال تاريخ بدء الدورة",
                "start_at.after_or_equal" =>"يجب ادخال تاريخ صحيح",
                "coupon_number.exists" =>"هذا الكوبون غير صحيح",
                "reserved_weeks_number.required"=>"يجب ادخال عدد الاسابيع",
                "reserved_weeks_number.numeric"=>"يجب ان يكون عدد الاسابيع رقم ",

            ]);
        }else{
            $valid = validator::make($data,[
                "living_id"             =>"numeric|exists:living",
                "medical_insurance_id"  =>"numeric|exists:medical_insurance",
                "airport_id"            =>"numeric|exists:airport_rec",
                "start_at"              =>"required|after_or_equal:today|date",
                "reserved_weeks_number" =>"required|numeric",
                "coupon_number"         =>"exists:coupons",
            ]);
        }
 
        
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }


        if($check =reservationUserModel::checkPassport( $STID )){
            if($reservation_id = reservationUserModel::addreserve($data)){

                $resrvDetails = reservationUserModel::getReserveMail($STID,$reservation_id);
                $resrvDetails->course_name                = $resrvDetails->{'course_name'.$lang};
                $resrvDetails->institute_name             = $resrvDetails->{'institute_name'.$lang};
                $resrvDetails->living_name                = $resrvDetails->{'living_name'.$lang};
                $resrvDetails->country                    = $resrvDetails->{'country'.$lang};
                $resrvDetails->city_name                    = $resrvDetails->{'city_name'.$lang};


                $website = reservationUserModel::getWebsite();
                $socialMedia = reservationUserModel::getSocial();

                $logo = reservationUserModel::getLogo();
                $logoPath = 'storage/images/logo/';
                $fullPath = public_path($logoPath.$logo);
                
                // return $fullPath;
                $url =  URL::to('/');

                $studentPDF = PDF::loadView('user.ar.pdf.PDFbody', compact('logo','resrvDetails','lang' ,'url', 'website'));
                $institutePDF = PDF::loadView('user.ar.pdf.PDFbodyInstitute', compact('logo','resrvDetails','lang' ,'url' , 'website'));
                    // return $institutePDF->download('x.pdf');
                $res = Mail::to($resrvDetails->student_email)->send(new sentInvoice($studentPDF->output(),$resrvDetails,$lang,$website,$socialMedia,$fullPath));
                if ($res == null){
                        
                    $res2 = Mail::to($resrvDetails->institute_email)->send(new sendInvoiceInst($institutePDF->output(),$resrvDetails,$lang,$website,$socialMedia,$fullPath));
                    if ($res2 == null){
                        if($lang == '_ar'){
                            return redirect('my-reservations')->with("Success","<script>Swal.fire({icon: 'success', title: 'قد تم الحجز بنجاح'});</script>");
                        }else{
                            return redirect('my-reservations')->with("Success","<script>Swal.fire({icon: 'success', title: 'Reservation has been successfully'});</script>");
                        }
                    }
                    //second mail fails
                    if($lang == '_ar'){
                        return redirect('my-reservations')->with("Error","<script>Swal.fire({icon: 'error', title: 'خطأ يرجى اعادة المحاولة'});</script>");
                    }else{
                        return redirect('my-reservations')->with("Error","<script>Swal.fire({icon: 'error', title: 'Please Try Again'});</script>");
                    }
                }
                //first mail fails
                if($lang == '_ar'){
                    return redirect('my-reservations')->with("Error","<script>Swal.fire({icon: 'error', title: 'خطأ يرجى اعادة المحاولة'});</script>");
                }else{
                    return redirect('my-reservations')->with("Error","<script>Swal.fire({icon: 'error', title: 'Please Try Again'});</script>");
                }     
                
            }
            abort(401);
        }else{
            return redirect('passport-reservation');
        }

            
    }

    public function passportDetails(Request $request)
    {
        if($redirect = $request->header('referer')){
            Session()->put('redirect',$redirect);
        }else{
            Session()->put('redirect','/');
        }
        $lang = parent::detectUserLang();
        $STID = Session()->get('user_id');
        $profile = authUserModel::getProfile($STID);
        if($lang == '_ar'){
            return view('user.ar.profile',[
                'insertFirst'=>1
            ]);
        }else{
            return view('user.en.profile',[
                'insertFirst'=>1
            ]);
        }
    }
    public function myReservations(Request $request)
    {
        $STID = Session()->get('user_id');

        $lang = parent::detectUserLang();
        if($lang == "_ar"){
            Carbon::setLocale('ar');
        }

        $currentReservations = reservationUserModel::mycurrentReservation($STID);
        $totalCurrentReservations = [];
        foreach ($currentReservations as $key => $value) {
            $recordCourse = [
                "reservation_id"                    =>intval($value->reservation_id),
                "course_photo"                      =>$value->course_photo,
                "course_name"                       =>$value->{'course_name'.$lang},
                'course_details'                    =>$value->{'course_details'.$lang},
                "from"                              =>Carbon::parse($value->created_at)->diffForHumans(),
                "total"                             =>$value->total,
            ];        
            array_push($totalCurrentReservations , $recordCourse);
        }

        $perviousReservations = reservationUserModel::mylastReservation($STID);
        $totalPerviousReservations = [];
        foreach ($perviousReservations as $key => $value) {
            $recordCourse = [
                "reservation_id"                    =>intval($value->reservation_id),
                "course_photo"                      =>$value->course_photo,
                "course_name"                       =>$value->{'course_name'.$lang},
                'course_details'                    =>$value->{'course_details'.$lang},
                "from"                              =>Carbon::parse($value->created_at)->diffForHumans(),
                "total"                             =>$value->total,
            ];        
            array_push($totalPerviousReservations , $recordCourse);
        }

        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            return view('user.ar.myReservation',[
                "currentReservations"=>$currentReservations,
                "totalCurrentReservations"=>$totalCurrentReservations,
                "perviousReservations"=>$perviousReservations,
                "totalPerviousReservations"=>$totalPerviousReservations,

            ]);
        }else{
            return view('user.en.myReservation',[
                "currentReservations"=>$currentReservations,
                "totalCurrentReservations"=>$totalCurrentReservations,
                "perviousReservations"=>$perviousReservations,
                "totalPerviousReservations"=>$totalPerviousReservations,
            ]);
        }
    }

    function reservationsDetails(Request $request,$STID,$reservation_id)
    {
        // return $STID.$reservation_id ;
        $lang = parent::detectUserLang();
        // return $STID;
        $reservationDetails = reservationUserModel::getCourseReserve($STID,$reservation_id);

        $reservationDetails->reservation_id             = $reservationDetails->reservation_id;
        $reservationDetails->course_id                  = $reservationDetails->course_id;
        $reservationDetails->course_name                = $reservationDetails->{'course_name'.$lang};
        $reservationDetails->institute_name             = $reservationDetails->{'institute_name'.$lang};
        $reservationDetails->course_photo               = $reservationDetails->course_photo;
        $reservationDetails->institute_details          = $reservationDetails->{'institute_details'.$lang};
        $reservationDetails->course_details             = $reservationDetails->{'course_details'.$lang};
        $reservationDetails->start_at                   = $reservationDetails->start_at;
        $reservationDetails->reserved_weeks_number      = $reservationDetails->reserved_weeks_number;
        $reservationDetails->living_name                = $reservationDetails->{'living_name'.$lang};
        $reservationDetails->airport_rec_name           = $reservationDetails->{'airport_rec_name'.$lang};
        $reservationDetails->medical_insurance_name     = $reservationDetails->{'medical_insurance_name'.$lang};
        $reservationDetails->course_price               = $reservationDetails->course_price;
        $reservationDetails->registration_fees          = $reservationDetails->registration_fees;
        $reservationDetails->living_fees                = $reservationDetails->living_fees;
        $reservationDetails->mail_fees                  = $reservationDetails->mail_fees;
        $reservationDetails->book_fees                  = $reservationDetails->book_fees;
        $reservationDetails->summer_fees                = $reservationDetails->summer_fees;
        $reservationDetails->tax_fees                   = $reservationDetails->tax_fees;
        $reservationDetails->summer_fees                = $reservationDetails->summer_fees;
        $reservationDetails->living_price               = $reservationDetails->living_price;
        $reservationDetails->airport_rec_price          = $reservationDetails->airport_rec_price;
        $reservationDetails->medical_insurance_price    = $reservationDetails->medical_insurance_price;
        $reservationDetails->total                      = $reservationDetails->total;


        if($lang == '_ar'){
            return view('user.ar.reservationDetails',[
                'reservationDetails' =>$reservationDetails
            ]);
        }else{
            return view('user.en.reservationDetails',[
                'reservationDetails' =>$reservationDetails
            ]);
        }


    }

    public function SendInvoice(Request $request,$STID,$reservation_id )
    {
        // $lang = parent::detectUserLang($request);
        // $resrvDetails = reservationUserModel::getReserve($STID,$reservation_id);
        // if($resrvDetails = reservationUserModel::getReserve($STID,$reservation_id)){
        //     $reservationDetails = [];
        //     foreach ($resrvDetails as $key => $value) {

        //         $reservationDetails = [
        //             "reservation_id"            =>intval($value->reservation_id),
        //             "student_id"                =>intval($value->student_id),
        //             "course_photo"              =>$value->course_photo,
        //             "course_name"               =>$value->{'course_name'.$lang},
        //             "start_date"                =>$value->start_at,
        //             "institute"                 =>$value->{'institute_name'.$lang},
        //             "living"                    =>$value->{'living_name'.$lang},
        //             "ariport_rec"               =>$value->{'airport_rec_name'.$lang},
        //             "medical_insurance"         =>$value->{'medical_insurance_name'.$lang},
        //             "week_price"                =>$value->week_price,
        //             "register_fees"             =>$value->registration_fees,
        //             "residence_fees"            =>$value->living_fees,
        //             "carier_fees"               =>$value->airport_rec_price,
        //             "extra_fees_in_summer"      =>$value->summer_fees,
        //             "book_fees"                 =>$value->book_fees,
        //             "vat"                       =>$value->tax_fees,
        //             "houseing_price"            =>$value->housing_price,
        //             "reception_price"           =>$value->reception_price,
        //             "insurance_price"           =>$value->insurance_price,
        //             "weeks_number"              =>$value->weeks_number,
        //             "total"                     =>$value->total

        //         ];

        //      }
        //      $userData = reservationUserModel::getSTData($STID);
        //      $res = Mail::to($userData->student_email)->send(new sentInvoice($reservationDetails,$lang));
        //     if ($res == null){
        //         if($lang == '_ar'){
        //             return redirect()->back()->with("Success","<script>Swal.fire({icon: 'success', title: ' تم ارسال الفاتوره بنجاح '});</script>");
        //         }else{
        //             return redirect()->back()->with("Success","<script>Swal.fire({icon: 'success', title: 'Bill has been successfully sent'});</script>");
        //         }   
        //     }
        //     if($lang == '_ar'){
        //         return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'خطأ يرجى اعادة المحاولة'});</script>");
        //     }else{
        //         return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'Please Try Again'});</script>");
        //     }   


        // }else{
        //     if($lang == '_ar'){
        //         return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'خطأ يرجى اعادة المحاولة'});</script>");
        //     }else{
        //         return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'Please Try Again'});</script>");
        //     }   
        // }


    }
    
     public function pdfDown(Request $request,$STID,$reservation_id )
    {

        $lang = parent::detectUserLang($request);
        if($resrvDetails = reservationUserModel::getReserveMail($STID,$reservation_id)){
            $resrvDetails->course_name                = $resrvDetails->{'course_name'.$lang};
            $resrvDetails->institute_name             = $resrvDetails->{'institute_name'.$lang};
            $resrvDetails->living_name                = $resrvDetails->{'living_name'.$lang};
            $resrvDetails->country                    = $resrvDetails->{'country'.$lang};
            $resrvDetails->city_name                    = $resrvDetails->{'city_name'.$lang};


            $website = reservationUserModel::getWebsite();
            $socialMedia = reservationUserModel::getSocial();

            $logo = reservationUserModel::getLogo();
            $logoPath = 'storage/images/logo/';
            $fullPath = public_path($logoPath.$logo);
            
            // return $fullPath;
            $url =  URL::to('/');

            $studentPDF = PDF::loadView('user.ar.pdf.PDFbody', compact('logo','resrvDetails','lang' ,'url', 'website'));
            
                // return $institutePDF->download('x.pdf');
            $res = Mail::to($resrvDetails->student_email)->send(new sentInvoice($studentPDF->output(),$resrvDetails,$lang,$website,$socialMedia,$fullPath));
            if ($res == null){
                    
                    if($lang == '_ar'){
                        return redirect()->back()->with("Error","<script>Swal.fire({icon: 'success', title: ' تم ارسال الفاتورة بنجاح'});</script>");

                    }else{
                        return redirect()->back()->with("Error","<script>Swal.fire({icon: 'success', title: 'The invoice has been sent successfully '});</script>");
                    }
            }
            if($lang == '_ar'){
                return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'خطأ يرجى اعادة المحاولة'});</script>");
            }else{
                return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'Please Try Again'});</script>");
            }


        }else{
            if($lang == '_ar'){
                return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'خطأ يرجى اعادة المحاولة'});</script>");
            }else{
                return redirect()->back()->with("Error","<script>Swal.fire({icon: 'error', title: 'Please Try Again'});</script>");
            }
        }

    }
}
