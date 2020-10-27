<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\indexModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
class indexController extends Controller
{

   public function indexdash()
   {
       //
       $courses = indexModel::noOfCourses();
       $institute = indexModel::noOfInstitute();
       $online = indexModel::noOfOnlineCourse();
       $student = indexModel::noOfStudent();
       $allResertvation = indexModel::noOfAllReservation();
       $confirmedReservation = indexModel::noOfConfirmed();
       $canceledReservation = indexModel::noOfCancel();
       $compelete = indexModel::noOfcompelete();
       $pending = indexModel::noOfPending();
       $max = indexModel::mostInstitute();
       $pendingmsg = indexModel::pendingMsg();
       $replyedmsg = indexModel::replyedMsg();
       // return $max;
       return view('admin.dashboard',[
           'noOfCourses' => $courses,
           'noOfInstitute' => $institute,
           'noOfOnlineCourse'=>$online,
           'noOfStudent'=>$student,
           'noOfAllReservation' =>$allResertvation,
           'noOfConfirmed' =>$confirmedReservation,
           'noOfCancel' =>$canceledReservation,
           'noOfcompelete'=>$compelete,
           'noOfPending'=>$pending,
           'max'=> $max,
           'pendingMsg'=> $pendingmsg,
           'replyedMsg' => $replyedmsg,


       ]);
   }
   
   public function index()
   {
      // $recentInst = indexModel::recentInst();
      // $recentCourses = indexModel::recentCourses();
      // return view('ar.index',[
      //     'recentInsts' => $recentInst,
      //     'recentCourses'=>$recentCourses
      // ]);
      return view('welcome');
   }

   public function test1($id)
   {
   
      Session()->put('user',$id);
      var_dump(Session()->get('user'));

        
   }
   public function test2(Request $request)
   {
   
      var_dump(Session()->get('user'));
        
   }
   public function testGet()
   {
      $page = DB::table('user_courses_rate_view')->select('course_id','course_photo','avg_rate_c','institute_name_ar','course_name_ar','course_price')->paginate(2);
      
      
      foreach ($page->toArray() as $key => $value) {
        echo($key . '<br>');
        print_r($page->toArray()["first_page_url"]);
      //   print_r($page->toArray()["data"]->course_name_ar);
      }
      echo("<pre>");
      print_r($page->toArray()["data"][0]->course_id);
      echo("<pre>");
   }

   public function testAjax()
   {
      return view('ajaxRequest');
   }
   public function body(Request $request)
   {
      // $resrvDetails =  DB::table('user_reservations_view')->select('*')->where([['student_id' , '=' , 1],['reservation_id' , '=' , 5]])->first();
      // $website = DB::table('website_info')->select('*')->first();
      // $socialMedia = DB::table('social_media')->select('*')->get();
      // $logo = $website->logo;
      // $logoPath = 'storage/images/logo/';
      // $fullPath = url($logoPath.$logo);
      // return view('user.ar.mails.invoiceBody',[
      //    'lang'=>$request->lang,
      //    'resrvDetails'=>$resrvDetails,
      //    'fullPath'=>$fullPath,
      //    'website'=>$website,
      //    'socialMedia'=>$socialMedia,
      // ]);
   }
}
