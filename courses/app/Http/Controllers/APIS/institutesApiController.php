<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\APIS\institutesApiModel;
use App\APIS\coursesApiModel;
use Illuminate\Support\Facades\Validator;
use App\APIS\reservationApiModel;
use Illuminate\Support\Facades\URL;

class institutesApiController extends Controller
{
    public function get_institutes_pagination(Request $request)
    {
        $lang = parent::detectLang($request);
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

            ]);

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
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }

        $photo_path =  URL::to('/').'/storage/institutes/courses/';

        if($pageinate = institutesApiModel::institute_page()){

            $total_records = array();
            $record = array();
            $pagination = array();
            foreach ($pageinate as $key => $value) {
                $numberOfCourses = institutesApiModel::count_of_courses($value->institute_id);
                $record = [
                                "institute_id"              =>intval($value->institute_id),
                                "institute_image"           =>$photo_path.$value->institutes_photo,
                                "institute_rate"            =>$value->avg_rate_i,
                                "institute"                 =>$value->{'institute_name'.$lang},
                                "institute_about"           =>$value->{'institute_details'.$lang},
                                "counrty"                   =>$value->{'country'.$lang},
                                "city"                      =>$value->{'city_name'.$lang},
                                "courses_count"             =>$numberOfCourses

                ];
                array_push($total_records,$record);
                $pagination = [

                                "current_page"      =>$pageinate->currentPage(),
                                "next_page_url"     =>$pageinate->nextPageUrl(),
                                "pervious_page_url" =>$pageinate->previousPageUrl(),
                                "total_records"     =>$pageinate->total(),
                                "per_page"          =>$pageinate->perPage(),
                                "last_item"         =>$pageinate->lastItem(),
                                "last_page"         =>$pageinate->lastPage(),

                ];
             }
             if($pagination == null){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
            }
            return response()->json(['success'=>true,"result"=>["institutes"=>$total_records,"pagination"=>$pagination]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }
    }

    public function instituteDetails(Request $request)
    {
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $lang = parent::detectLang($request);

        $valid = validator::make($request->all(),[
            'institute_id'=>'required|numeric'

        ]);

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

        $photo_path =  URL::to('/').'/storage/institutes/courses/';


        if($instituteDetails = institutesApiModel::getInstituteDetails($request->institute_id)){

            $jsonData = array();
            foreach ($instituteDetails as $key => $value) {

                $jsonData = [
                        "institute_id"              =>intval($value->institute_id),
                        "institute_image"           =>$photo_path.$value->institutes_photo,
                        "institute_rate"            =>$value->avg_rate_i,
                        "institute_rate_count"      =>institutesApiModel::getInstituteCountRate($request->institute_id),
                        "institute"                 =>$value->{'institute_name'.$lang},
                        "institute_about"           =>$value->{'institute_details'.$lang},
                        "counrty"                   =>$value->{'country'.$lang},
                        "city"                      =>$value->{'city_name'.$lang},

                ];


             }


             $instituteCourses =  institutesApiModel::get_institute_courses($request->institute_id);
             $totalInstituteCourses = array();
             foreach ($instituteCourses as $key => $value) {

                if(coursesApiModel::checkWish($value->course_id,$STID)){
                    $wish = true;
                }else{
                    $wish = false;
                }

                $instituteCoursesRecord = [
                                    "id"            =>$value->course_id,
                                    "liked"         =>$wish,
                                    "image"         =>$value->course_photo,
                                    "rate"          =>$value->avg_rate_c,
                                    "institute"     =>$value->{'institute_name'.$lang},
                                    "title"         =>$value->{'course_name'.$lang},
                                    "price"         =>$value->course_price
                ];
                array_push($totalInstituteCourses,$instituteCoursesRecord);
             }


             $onlineCourses =  institutesApiModel::get_institute_online($request->institute_id);
             $totalOnlineCourses = array();
             foreach ($onlineCourses as $key => $value) {
                $onlineCoursesRecord = [
                                "online_course_id"=>$value->online_course_id,
                                "online_course_name"=>$value->{'online_course_name'.$lang},
                                "online_course_details"=>$value->{'online_course_details'.$lang},
                                "online_course_link"=>$value->online_course_link,
                                "online_course_photo"=>$value->online_course_photo,
                                "institute_name"=>$value->{'institute_name'.$lang},
                ];
                array_push($totalOnlineCourses,$onlineCoursesRecord);
             }




             return response()->json(['success'=>true,"result"=>["institute"=>["institute_details"=>$jsonData,"institute_courses"=>$totalInstituteCourses,"institute_online_courses"=>$totalOnlineCourses]]],200);


        }else{

            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);

        }

    }

    public function instituteSearch(Request $request)
    {
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);

        $keyValidation = '';
        if($lang == ''){
            $keyValidation = 'regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/';
        }
        $valid = validator::make($request->all(),[
            'keyword'=>$keyValidation,
            // 'country'=>'numeric',
            // 'city'=>'numeric',
            'sort_by'=>'numeric|min:1|max:2',
            'page'=>'numeric'

        ]);

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
            if($lang == "_ar"){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);


        }


        $key = null;$city = null;$loc = null;$sort = null;$sortCondtion = null;
        $total = array();
        $where = array();

        $total['cityFlag'] = null;
        $total['countryFlag'] = null;

        if ($request->has('keyword')) {
            $key = $request->input('keyword');
            $test = ['institute_name'.$lang,'LIKE','%'.$key.'%'];
            array_push($where,$test);

        }
        if ($request->has('city')) {
            $cityFlag = 1;

            $city = $request->input('city');
            $city_arr = json_decode($city);

            // $test = ['city_id','=',$city];
            // array_push($total,$test);
            $total['cityFlag'] = $cityFlag;
            $total['city_id']= 'city_id';
            $total['city_arr']= $city_arr;


        }
        if ($request->has('country')) {
            $countryFlag = 1;
            $country = $request->input('country');
            $country_arr = json_decode($country);

            // $test = ['location_id','=',$country];
            // array_push($total,$test);
            $total['countryFlag'] = $countryFlag;
            $total['location_id']= 'location_id';
            $total['country_arr']= $country_arr;
        }

        if ($request->has('sort_by')) {
            $sort = $request->input('sort_by');
            if($sort == 1){
                $sortCondtion = 'ASC';
            }
            if($sort == 2){
                $sortCondtion = 'DESC';
            }
        }else{
            $sortCondtion = 'DESC';
        }
        // return $sortCondtion;
        //  institutesApiModel::getInstituteSearch($total,$sortCondtion)


        $photo_path =  URL::to('/').'/storage/institutes/courses/';
        if($fitleration =  institutesApiModel::getInstituteSearch($where,$total,$sortCondtion)){

            $total_records = array();
            $record = array();

            if($fitleration->isEmpty()){
                if($lang == "_ar"){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);

            }
            foreach ($fitleration as $key => $value) {

                $numberOfCourses = institutesApiModel::count_of_courses($value->institute_id);

                $record = [
                                "institute_id"              =>intval($value->institute_id),
                                "institute_image"           =>$photo_path.$value->institutes_photo,
                                "institute_rate"            =>$value->avg_rate_i,
                                "institute"                 =>$value->{'institute_name'.$lang},
                                "institute_about"           =>$value->{'institute_details'.$lang},
                                "counrty"                   =>$value->{'country'.$lang},
                                "city"                      =>$value->{'city_name'.$lang},
                                "courses_count"             =>$numberOfCourses

                ];
                array_push($total_records,$record);
                $pagination = [

                                "current_page"      =>$fitleration->currentPage(),
                                "next_page_url"     =>$fitleration->nextPageUrl(),
                                "pervious_page_url" =>$fitleration->previousPageUrl(),
                                "total_records"     =>$fitleration->total(),
                                "per_page"          =>$fitleration->perPage(),
                                "last_item"         =>$fitleration->lastItem(),
                                "last_page"         =>$fitleration->lastPage(),

                ];
             }

            return response()->json(['success'=>true,"result"=>["institutes"=>$total_records,"pagination"=>$pagination]],200);



        }else{
            if($lang == "_ar"){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);
        }




    }

    public function instituteRate(Request $request)
    {

        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $valid = validator::make($request->all(),[
            'institute_id'=>'numeric',
            'institute_rate'=>'numeric',


        ]);

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
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"","details"=>$jsonError]],401);


        }
        $rate = new institutesApiModel;
        $rate->institute_rate_value = $request->institute_rate;
        $rate->institute_id = $request->institute_id;

        $rate->student_id = $STID;

        if(institutesApiModel::setInstituteRate($rate)){
                return response()->json(['success'=>true,'result' =>(object)[]],200);
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }


    }

    public function getPageInstituteSearch(Request $request)
    {
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
            
        $lang = parent::detectLang($request);

       
        
        if($getAllCountries = institutesApiModel::getAllCountries($lang)){

            $total_records = array();
            $record = array();
    
            foreach ($getAllCountries  as $key => $value) {
    
                $record = [
                    "country_id"=>$value->{'location_id'},
                    "contry"=>$value->{'country'.$lang},
    
                ];
                array_push($total_records,$record);
                
             }
    
    
        //     return response()->json(['success'=>true,"result"=>["courses_types"=>$total_records]],200);
    
        

            if($allCitites= coursesApiModel::getAllCities($lang)){


                $allInstitutesCitites = array();
                $record = array();
        
                foreach ($allCitites  as $key => $value) {
        
                    $record = [
                        "city_id"=>$value->{'city_id'},
                        "city_name"=>$value->{'city_name'.$lang},
        
                    ];
                    array_push($allInstitutesCitites,$record);
                    
                }

                return response()->json(['success'=>true,"result"=>["search_data"=>["countries"=>$total_records,"cities"=>$allInstitutesCitites]]],200);
            
            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
            }
    
           
    
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
        }


    }

}
