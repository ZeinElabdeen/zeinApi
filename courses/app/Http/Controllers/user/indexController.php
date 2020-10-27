<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user\indexModel;
use App\models\user\courseUserModel;
use Illuminate\Support\Facades\URL;
use App\models\user\staticPageModel;
use App\models\user\instituteUserModel; 
class indexController extends Controller
{
    public function index()
    {
        // $c = new indexModel;
        // Session()->forget('userLang');
        $lang = parent::detectUserLang();       
        $recentCourses = indexModel::recentCourses();
        $totalCourses = [];
        foreach ($recentCourses as $key => $value) {
            if(courseUserModel::checkWish($value->course_id,Session()->get('user_id'))){
                $wish = true;
            }else{
                $wish = false;
            }
            $recordCourse = [
                
                "course_id"             =>intval($value->course_id),
                "course_photo"          =>$value->course_photo,
                "avg_rate_c"            =>$value->avg_rate_c,
                "institute_name"        =>$value->{'institute_name'.$lang},
                "course_name"           =>$value->{'course_name'.$lang},
                "course_price"          =>floatval($value->course_price),
                'course_details'        =>$value->{'course_details'.$lang},
                'liked'                 =>$wish,
            ];        
            array_push($totalCourses , $recordCourse);
        }

       
        $recentInst = indexModel::recentInst();
        $totalInstitutes = [];
        foreach ($recentInst as $key => $value) {
            $recordIstitute = [
                "institute_id"          =>intval($value->institute_id),
                "institutes_photo"      =>$value->institutes_photo,
                "avg_rate_i"            =>$value->avg_rate_i,
                "institute_name"        =>$value->{'institute_name'.$lang},
                "institute_details"     =>$value->{'institute_details'.$lang},
                'country'               =>$value->{'country'.$lang},
                'city_name'             =>$value->{'city_name'.$lang},
                'courses_count'         =>intval(instituteUserModel::getNoCoursesOfInst($value->institute_id)),

            ];        
            array_push($totalInstitutes , $recordIstitute);
        }

        $CourseTypes = courseUserModel::getAllCourseTypes();
        $totalCourseTypes = [];
        foreach ($CourseTypes as $key => $value) {
            $recordCourse = [
                "course_type_id"             =>intval($value->course_type_id),
                "course_type_name"           =>$value->{'course_type_name'.$lang},
            ];        
            array_push($totalCourseTypes , $recordCourse);
        }

        $about = staticPageModel::getaboutUs();
        $about->title = $about->{'title'.$lang};
        $about->details = $about->{'details'.$lang};
        $about->page_photo = $about->page_photo;


        // silder index
        $slider = staticPageModel::getsliderindex();
        $allSlider = [];
        foreach($slider as $key =>$value){
            $rowOfSlider = [
                'slider_title' => $value->{'slider_title'.$lang},
                'slider_details' => $value->{'slider_details'.$lang},
                'slider_link' => $value->slider_link,
                'slider_photo' => $value->slider_photo,

            ];
            array_push($allSlider,$rowOfSlider);
        }
        // application ads
        $ads = staticPageModel::getAdsApp();
        $ads->ads_title         = $ads->{'ads_title'.$lang};
        $ads->ads_details       = $ads->{'ads_details'.$lang};
        $ads->ads_andriod_link  = $ads->ads_andriod_link;
        $ads->ads_ios_link      = $ads->ads_ios_link;
        $ads->ads_cover_photo   = $ads->ads_cover_photo;
        
        // return $totalCourses;
        if($lang == '_ar'){
            return view('user.ar.index',[
                'recentInsts' => $totalInstitutes,
                'recentCourses'=>$totalCourses,
                'totalCourseTypes'=>$totalCourseTypes,
                'about'=>$about,
                'slider'=>$allSlider,
                'ads'=>$ads,
            ]);
        }else{
            return view('user.en.index',[
                'recentInsts' => $totalInstitutes,
                'recentCourses'=>$totalCourses,
                'totalCourseTypes'=>$totalCourseTypes,
                'about'=>$about,
                'slider'=>$allSlider,
                'ads'=>$ads,

            ]);
        }
        
        
    }
}
