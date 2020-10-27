<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user\instituteUserModel;
use Illuminate\Support\Facades\Validator;

class instituteUserController extends Controller
{
    //

    public function index()
    {
        $lang = parent::detectUserLang();
        $allInstitutes = instituteUserModel::getAllInstitute();
        $totalInstitute = [];

        foreach ($allInstitutes as $key => $value) {
            $recordInstitute = [
                "institute_id"              =>intval($value->institute_id),
                "institutes_photo"          =>$value->institutes_photo,
                "avg_rate_i"                =>$value->avg_rate_i,
                "institute_name"            =>$value->{'institute_name'.$lang},
                "country"                   =>$value->{'country'.$lang},
                "city_name"                 =>$value->{'city_name'.$lang},
                'institute_details'         =>$value->{'institute_details'.$lang},
                'courses_count'             =>intval(instituteUserModel::getNoCoursesOfInst($value->institute_id)),
            ];
            array_push($totalInstitute , $recordInstitute);
        }


        $countries = instituteUserModel::getAllCountries();
        $totalCountries = [];
        foreach ($countries as $key => $value) {
            $recordCourse = [
                "location_id"             =>intval($value->location_id),
                "country"           =>$value->{'country'.$lang},
            ];        
            array_push($totalCountries , $recordCourse);
        }

        $cities = instituteUserModel::getAllCities();
        $totalCities = [];
        foreach ($cities as $key => $value) {
            $recordCourse = [
                "city_id"             =>intval($value->city_id),
                "city_name"           =>$value->{'city_name'.$lang},
            ];        
            array_push($totalCities , $recordCourse);
        }



        if($lang == '_ar'){
            return view('user.ar.allInstitute',[
                'allInstitutes' => $allInstitutes,
                'totalInstitute'=>$totalInstitute,
                'totalCities'=>$totalCities,
                'totalCountries'=>$totalCountries,


            ]);
        }else{
            return view('user.en.allInstitute',[
                'allInstitutes' => $allInstitutes,
                'totalInstitute'=>$totalInstitute,
                'totalCities'=>$totalCities,
                'totalCountries'=>$totalCountries,


            ]);
        }
    }
    public function instituteDetails($id)
    {
        $lang = parent::detectUserLang();
        $InstitutesDetails = instituteUserModel::getInstituteInfo($id);
        $countRateInstitute = instituteUserModel::getCountRateInst($InstitutesDetails->institute_id);
        // return $countRateInstitute;

        $InstitutesDetails->institute_name      = $InstitutesDetails->{'institute_name'.$lang};
        $InstitutesDetails->institute_details   = $InstitutesDetails->{'institute_details'.$lang};
        $InstitutesDetails->country             = $InstitutesDetails->{'country'.$lang};
        $InstitutesDetails->city_name           = $InstitutesDetails->{'city_name'.$lang};
        $InstitutesDetails->institutes_photo     = $InstitutesDetails->institutes_photo;
        $InstitutesDetails->avg_rate_i           = $InstitutesDetails->avg_rate_i;
        $InstitutesDetails->countRateInstitute   = $countRateInstitute;
        // $InstitutesDetails->countRateInstitute
        // dump($InstitutesDetails);
        $instituteCousre = instituteUserModel::getInstituteCourse($id);
        $totalInstituteCourse = [];
        foreach ($instituteCousre as $key => $value) {
                $recordInstitute = [
                    // "institute_id"             =>intval($value->institute_id),
                    "course_id"             =>intval($value->course_id),
                    "course_photo"          =>$value->course_photo,
                    "avg_rate_c"            =>$value->avg_rate_c,
                    "institute_name"        =>$value->{'institute_name'.$lang},
                    "course_name"           =>$value->{'course_name'.$lang},
                    "course_price"          =>floatval($value->course_price),
                    'course_details'        =>$value->{'course_details'.$lang},
                ];
                array_push($totalInstituteCourse , $recordInstitute);
            }

            // return $recordInstitute;
            // var_dump($instituteCousre['recordInstitute']);
            // $totalInstituteCourse['course_id']
        $instituteCourseOnline = instituteUserModel::getinstituteCourseOnline($id);
        $totalInstituteCourseOnline = [];
        foreach ($instituteCourseOnline as $key => $value) {
                $recordInstituteOnline = [
                    "online_course_id"             =>intval($value->online_course_id),
                    "online_course_name"          =>$value->{'online_course_name'.$lang},
                    "institute_name"        =>$value->{'institute_name'.$lang},
                    "online_course_details"           =>$value->{'online_course_details'.$lang},
                    "online_course_link"            =>$value->online_course_link,
                    "online_course_photo"          =>$value->online_course_photo,
                ];
                array_push($totalInstituteCourseOnline , $recordInstituteOnline);
            }


        if($lang == '_ar'){
            return view('user.ar.instituteDetails',[
                'InstitutesDetails' => $InstitutesDetails,
                'instituteCousre'=>$totalInstituteCourse,
                'instituteCourseOnline'=>$totalInstituteCourseOnline,
            ]);
        }else{
            return view('user.en.instituteDetails',[
                'InstitutesDetails' => $InstitutesDetails,
                'instituteCousre'=>$totalInstituteCourse,
                'instituteCourseOnline'=>$totalInstituteCourseOnline,
            ]);
        }
    }

    public function instituteSearch(Request $request)
    {
        
        $lang = parent::detectUserLang();

        $key = null;$type = null;$loc = null;$sort = null;$sortCondtion = null;
        $total = array();
        $search = array();
        $keywordArr = array();

        if(isset($request->keyword)){

            $valid = validator::make($request->all(),[
                    // 'keyword'=>'',
                ]);
            if($valid->fails()){
                abort(404);
            }

            $key = $request->input('keyword');
            $searchEn = ['institute_name','LIKE','%'.$key.'%'];
            $searchAr = ['institute_name_ar','LIKE','%'.$key.'%'];
            array_push($total,$searchEn);
            array_push($keywordArr,$searchAr);


        }
        if(isset($request->country)){

            $valid = validator::make($request->all(),[
                'country'=>'numeric',
            ]);
            if($valid->fails()){
                abort(404);
            }

            $type = $request->input('country');
            $search = ['location_id','=',$type];
            array_push($total,$search);
            array_push($keywordArr,$search);



        }
        if(isset($request->city)){

            $valid = validator::make($request->all(),[
                'city'=>'numeric',
            ]);
            if($valid->fails()){
                abort(404);
            }

            $loc = $request->input('city');
            $search = ['city_id','=',$loc];
            array_push($total,$search);
            array_push($keywordArr,$search);

        }


        //if sort by price exists it takes the highest priority
        $sortCondtion = new instituteUserModel;

        if(isset($request->rate)){

            $valid = validator::make($request->all(),[
                'rate'=>'numeric|min:1|max:2',
            ]);
            if($valid->fails()){
                abort(404);
            }

            $sort = $request->input('rate');
            if($sort == 1){
                $sortCondtion->cloumn = 'avg_rate_i';
                $sortCondtion->sortBy = 'ASC';
            }
            if($sort == 2){
                $sortCondtion->cloumn = 'avg_rate_i';
                $sortCondtion->sortBy = 'DESC';
            }

        }else{
            //default if there is no sorting condtions
            $sortCondtion->cloumn = 'avg_rate_i';
            $sortCondtion->sortBy = 'DESC';

        }
       
        // return $request->all();

        // return $keywordArr;            


        if($fitleration =  instituteUserModel::getInstituteSearch($total,$keywordArr,$sortCondtion)){

            $total_records = array();
            $record = array();
             if($fitleration->isEmpty()){
                if($lang == "_ar"){
                    return redirect('all-institutes')->with('Error','لا توجد نتائج بحث');
                }
                return redirect('all-institutes')->with('Error','No search result');

            }

            foreach ($fitleration as $key => $value) {

                $record = [
                                "institute_id"              =>intval($value->institute_id),
                                "institutes_photo"          =>$value->institutes_photo,
                                "avg_rate_i"                =>$value->avg_rate_i,
                                "institute_name"            =>$value->{'institute_name'.$lang},
                                "country"                   =>$value->{'country'.$lang},
                                "city_name"                 =>$value->{'city_name'.$lang},
                                'institute_details'         =>$value->{'institute_details'.$lang},
                                'courses_count'             =>intval(instituteUserModel::getNoCoursesOfInst($value->institute_id)),

                ];
                array_push($total_records,$record);
                
                
            }


            $countries = instituteUserModel::getAllCountries();
            $totalCountries = [];
            foreach ($countries as $key => $value) {
                $recordCourse = [
                    "location_id"             =>intval($value->location_id),
                    "country"           =>$value->{'country'.$lang},
                ];        
                array_push($totalCountries , $recordCourse);
            }

            $cities = instituteUserModel::getAllCities();
            $totalCities = [];
            foreach ($cities as $key => $value) {
                $recordCourse = [
                    "city_id"             =>intval($value->city_id),
                    "city_name"           =>$value->{'city_name'.$lang},
                ];        
                array_push($totalCities , $recordCourse);
            }


            if($lang == '_ar'){
                return view('user.ar.allInstitute',[
                    'allInstitutes' => $fitleration,
                    'totalInstitute'=>$total_records,
                    'totalCities'=>$totalCities,
                    'totalCountries'=>$totalCountries,
    
    
                ]);
            }else{
                return view('user.en.allInstitute',[
                    'allInstitutes' => $fitleration,
                    'totalInstitute'=>$total_records,
                    'totalCities'=>$totalCities,
                    'totalCountries'=>$totalCountries,
    

    
                ]);
            }


        }else{

            if($lang == "_ar"){
                return redirect('all-institutes')->with('Error','لا توجد نتائج بحث');
            }
            return redirect('all-institutes')->with('Error','No search result');
        }

        // return $request->all();
        
    }
    
}
