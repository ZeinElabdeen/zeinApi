<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\APIS\coursesApiModel;
use App\APIS\reservationApiModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;


class coursesApiController extends Controller
{ 
    public function get_courses_pagination(Request $request)
    {
        
        //  if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
            
        //     }else{
        //         $STID = '';
        //     }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
            // return $STID;
            
        $lang = parent::detectLang($request);

        if($lang == '_ar'){
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

            ],[
                'page.numeric'=>"يجب ان تحتوي عللى ارقام فقط "
            ]);
            // return "arabic";

        }else{
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

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
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }



        // return $request->access_token;
        $photo_path =  URL::to('/').'/storage/images/courses/';
        if($pageinate = coursesApiModel::course_page()){

            $total_records = array();
            $record = array();
            $pagination = array();
            foreach ($pageinate as $key => $value) {

                if(coursesApiModel::checkWish($value->course_id,$STID)){
                    $wish = true;
                }else{
                    $wish = false;
                }

                $record = [
                                "id"            =>intval($value->course_id),
                                "liked"         =>$wish,
                                "image"         =>$photo_path.$value->course_photo,
                                "rate"          =>$value->avg_rate_c,
                                "institute"     =>$value->{'institute_name'.$lang},
                                "title"         =>$value->{'course_name'.$lang},
                                "price"         =>floatval($value->course_price)

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
            return response()->json(['success'=>true,"result"=>["courses"=>$total_records,"pagination"=>$pagination]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }
    }

    public function courseDetails(Request $request)
    {

        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);

        if($lang == '_ar'){
            $valid = validator::make($request->all(),[
                'id'=>'required|numeric'

            ],[
                'id.required'=>"يجب ادخال كود الصفحة",
                "id.numeric"=>"يجب ان يكون كود الصفحة رقم "
            ]);

        }else{
            $valid = validator::make($request->all(),[
                'id'=>'required|numeric'

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
        
        $photo_path = URL::to('/').'/storage/images/courses/';

        if($courseDetails = coursesApiModel::getCourseDetails($request->id)){

            $jsonData = array();
            foreach ($courseDetails as $key => $value) {
                //get liked 
                if(coursesApiModel::checkWish($value->course_id,$STID)){
                    $wish = true;
                }else{
                    $wish = false;
                }
                //get count of rating
                
                    
                $jsonData = [
                                "id"            =>intval($value->course_id),
                                "liked"         =>$wish,
                                "image"         =>$photo_path.$value->course_photo,
                                "rate"          =>$value->avg_rate_c,
                                "rateCount"     =>coursesApiModel::getRateCount($value->course_id),
                                "institute"     =>$value->{'institute_name'.$lang},
                                "institute_about"=>strip_tags($value->{'institute_details'.$lang}),
                                "title"         =>$value->{'course_name'.$lang},
                                "about"         =>trim(strip_tags($value->{'course_details'.$lang})," "),
                                "price"         =>$value->course_price,
                                "week_price"    =>$value->week_price,
                                "register_fees" => $value->registration_fees,
                                "residence_fees"=> $value->living_fees,
                                "carier_fees"   => $value->mail_fees,
                                "extra_fees_in_summer"=> $value->summer_fees,
                                "book_fees"     =>$value->book_fees,
                                "vat"           => $value->tax_fees,
                                "counrty"       =>$value->{'country'.$lang},
                                "city"          =>$value->{'city_name'.$lang},
                                // "houseing_price"=> $value->housing_price,
                                // "reception_price"=> $value->insurance_price,
                                // "insurance_price"=> $value->reception_price,

                ];


             }


             $living =  coursesApiModel::courseDetailsLiving($request->id);
             $totalLiving = array();
             foreach ($living as $key => $value) {
                $livingRecord = [
                                "living_id"=>$value->living_id,
                                "living_price"=>$value->living_price,
                                "living_name"=>$value->{'living_name'.$lang},
                ];
                array_push($totalLiving,$livingRecord);
             }


             $insurance =  coursesApiModel::courseDetailsInsurance($request->id);
             $totalInsurance = array();
             foreach ($insurance as $key => $value) {
                $insuranceRecord = [
                                "medical_insurance_id"=>$value->medical_insurance_id,
                                "medical_insurance_price"=>$value->medical_insurance_price,
                                "medical_insurance_name"=>$value->{'medical_insurance_name'.$lang},
                ];
                array_push($totalInsurance,$insuranceRecord);
             }


            $airports =  coursesApiModel::courseDetailsAirport($request->id);
            $totalAirPorts = array();
             foreach ($airports as $key => $value) {
                $airPortsRecord = [
                                "airport_id"=>$value->airport_rec_id,
                                "airport_price"=>$value->airport_rec_price,
                                "airport_name"=>$value->{'airport_rec_name'.$lang},
                ];
                array_push($totalAirPorts,$airPortsRecord);
             }

             return response()->json(['success'=>true,"result"=>["course"=>["course_details"=>$jsonData,"living"=>$totalLiving,"insurance"=>$totalInsurance,"airport"=>$totalAirPorts]]],200);


        }else{

            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);

        }


    }

    public function courseSearch(Request $request)
    {

        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);
        // return $lang;
        $keyValidation = '';
        if($lang = '_ar'){
            $valid = validator::make($request->all(),[
                'keyword'=>$keyValidation,
                // 'course_type'=>'numeric',
                // 'international_or_local'=>'numeric',
                'sort_by'=>'numeric|min:1|max:2',
                'page'=>'numeric'

            ],[
                'course_type.numeric'=>"يجب ان يكون نوع الدورة رقم",
                "international_or_local.numeric"=>"يجب ان يكون منشأ الدورة رقم",
                "page.numeric"=>"يجب ان يكون رقم الصفحة رقم",
                "sort_by.numeric"=>"يجب ان يكون الترتيب رقم"

            ]);

        }
        else{
            $keyValidation = 'regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/';
            $valid = validator::make($request->all(),[
                'keyword'=>$keyValidation,
                // 'course_type'=>'numeric',
                // 'international_or_local'=>'numeric',
                'sort_by'=>'numeric|min:1|max:2',
                'page'=>'numeric'
                

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
            if($lang == "_ar"){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"sلا توجد نتائج بحث","details"=>array()]],401);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);


        }

        $key = null;$type = null;$loc = null;$sort = null;$sortCondtion = null;$weeks=null; 
        
        $total = array();
        $search = array();
        $orWhere = array();
        
        $where = array();
        $total['locationFlag'] = null;
        $total['courseTypeFlag'] = null;

        // if($request->has('weeks_number')){
        //     $weeks = $request->input('weeks_number');
        //     $afterJson = json_decode($weeks);
        //     $weeks_number = 'weeks_number';
        //     $data =    coursesApiModel::getCourseSearch2($weeks_number,$afterJson);

        //     return $data;

        // }
        // return $orWhere;
        if ($request->has('keyword')) {
            $key = $request->input('keyword');

            $search = ['course_name'.$lang,'LIKE','%'.$key.'%'];
            array_push($where,$search);
        }


        if ($request->has('course_type')) {
            $courseTypeFlag = 1;
            $type = $request->input('course_type');
            $course_type_arr = json_decode($type);
            // $search = ['course_type_id','=',$type];
            // array_push($total,$search);
            $total['courseTypeFlag'] = $courseTypeFlag;
            $total['course_type']= 'course_type_id';
            $total['course_type_arr']= $course_type_arr;
        }
        if ($request->has('international_or_local')) {
            $locationFlag = 1;
            $loc = $request->input('international_or_local');
            $international_or_local_arr = json_decode($loc);
            // $search = ['local_or_global','=',$loc];
            // array_push($total,$search);
            $total['locationFlag'] = $locationFlag;
            $total['international_or_local'] = 'local_or_global';
            $total['international_or_local_arr']= $international_or_local_arr;
        }
        // return $where;
        // return $total;
        


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
        // $test =  coursesApiModel::getCourseSearch2($total,$where,$sortCondtion);
        //    return $orSearch;
        // coursesApiModel::getCourseSearch($total,$orWhere,$sortCondtion)
        $photo_path = URL::to('/').'/storage/images/courses/';
        if($fitleration =  coursesApiModel::getCourseSearch2($total,$where,$sortCondtion))
        {

            $total_records = array();
            $record = array();
            $pagination = array();
            if($fitleration->isEmpty()){
                if($lang == "_ar"){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"dلا توجد نتائج بحث","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);

            }
            foreach ($fitleration as $key => $value)
            {
                if(coursesApiModel::checkWish($value->course_id,$STID)){
                    $wish = true;
                }else{
                    $wish = false;
                }
                $record = [
                        "id"            =>intval($value->course_id),
                        "liked"         =>$wish,
                        "image"         =>$photo_path.$value->course_photo,
                        "rate"          =>$value->avg_rate_c,
                        "institute"     =>$value->{'institute_name'.$lang},
                        "title"         =>$value->{'course_name'.$lang},
                        "price"         =>$value->course_price
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
            if($pagination == null){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
            }
                return response()->json(['success'=>true,"result"=>["courses"=>$total_records,"pagination"=>$pagination]],200);
        }else{

            if($lang == "_ar"){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);
        }
        // return $request->all();
    }

    public function courseRate(Request $request)
    {

        $lang = parent::detectLang($request);
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }

        if($lang == "_ar"){
            $valid = validator::make($request->all(),[
                'id'=>'numeric',
                'course_rate'=>'numeric'

            ],[
                'id.numeric'=>'يجب ان يكون كود الدورة رقم',
                'course_rate.numeric'=>'يجب ان يكون التقيم رقم'
            ]);
        }else{
            $valid = validator::make($request->all(),[
                'id'=>'numeric',
                'course_rate'=>'numeric'

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

        $rate = new coursesApiModel;
        $rate->course_rate_value = $request->course_rate;
        $rate->course_id = $request->id;

        $rate->student_id = $STID;

        if(coursesApiModel::setCourseRate($rate)){
                return response()->json(['success'=>true,'result' =>(object)[]],200);
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
        }


    }

    public function wishlistPage(Request $request)
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
        $photo_path = URL::to('/').'/storage/images/courses/';

        if($wishPage = coursesApiModel::wishlist($STID)){

            $record = [];
            $totalrecords=[];
            $pagination = [];
            foreach ($wishPage as $key => $value) {

                $record = [
                        "id"                =>intval($value->course_id),
                        "image"             =>$photo_path.$value->course_photo,
                        "title"             =>$value->{'course_name'.$lang},
                        "institute"         =>$value->{'institute_name'.$lang},
                        "rate"              =>$value->avg_rate_c,
                        "price"             =>$value->course_price
                ];
                array_push($totalrecords,$record);

                $pagination = [

                    "current_page"      =>$wishPage->currentPage(),
                    "next_page_url"     =>$wishPage->nextPageUrl(),
                    "pervious_page_url" =>$wishPage->previousPageUrl(),
                    "total_records"     =>$wishPage->total(),
                    "per_page"          =>$wishPage->perPage(),
                    "last_item"         =>$wishPage->lastItem(),
                    "last_page"         =>$wishPage->lastPage(),
                    ];

             }
             if($pagination == null){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
            }

             return response()->json(['success'=>true,"result"=>["courses"=>$totalrecords,"pagination"=>$pagination]],200);


        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
            }
    }

    public function addWish(Request $request)
    {

        $lang = parent::detectLang($request);
        if($lang == "_ar"){
            $valid = validator::make($request->all(),[
                'id'=>'numeric'
            ],[
                'id.numeric'=>'يجب ان يكون كود الدورة رقم'
            ]);
        }else{
            $valid = validator::make($request->all(),[
                'id'=>'numeric'
            ]);
            }
        $wishlist = new coursesApiModel;

        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $wishlist->course_id = $request->id;

        $wishlist->student_id = $STID;
        
        if(coursesApiModel::checkWish($wishlist->course_id,$wishlist->student_id)){
                if(coursesApiModel::removeWish($wishlist)){
                    return response()->json(['success'=>true,'result' =>(object)[]],200);

                }else{
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
                }
        }else{
                if(coursesApiModel::addWishlist($wishlist)){
                    return response()->json(['success'=>true,'result' =>(object)[]],200);
                }else{
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);
                }
        }
        
    }


    public function globalSearch(Request $request)
    {
        //pendiing in this function
        /*
        number of weeks
        start date
        destination
        */



        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);
        // return $lang;
        $keyValidation = '';
        if($lang = '_ar'){
            $valid = validator::make($request->all(),[
                'keyword'=>$keyValidation,
                'course_type'=>'numeric',
                'international_or_local'=>'numeric',
                'city_id'=>'numeric|exists:institutes_citites',
                'location_id'=>'numeric|exists:institute_location',
                'sort_by'=>'numeric|min:1|max:2',
                'sort_by_price'=>'numeric|min:1|max:2',
                'weeks_number'=>'numeric',
                'page'=>'numeric'

            ],[
                'course_type.numeric'=>"يجب ان يكون نوع الدورة رقم",
                "international_or_local.numeric"=>"يجب ان يكون منشأ الدورة رقم",
                "page.numeric"=>"يجب ان يكون رقم الصفحة رقم",
                "sort_by.numeric"=>"يجب ان يكون الترتيب رقم",
                "sort_by_price.numeric"=>"يجب ان يكون الترتيب رقم",
                'city_id.numeric'=>'يجب ان يكون كود المدينه رقم',
                'city_id.exists'=>'كود المدينة غير موجود',
                'location_id.numeric'=>'يجب ان يكون كود البلد رقم',
                'location_id.exists'=>'كود البلد غير موجود',

            ]);

        }
        else{
            $keyValidation = 'regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/';
            $valid = validator::make($request->all(),[
                'keyword'=>$keyValidation,
                'course_type'=>'numeric',
                'international_or_local'=>'numeric',
                'city_id'=>'numeric|exists:institutes_citites',
                'location_id'=>'numeric|exists:institute_location',
                'sort_by'=>'numeric|min:1|max:2',
                'sort_by_price'=>'numeric|min:1|max:2',
                'weeks_number'=>'numeric',
                'page'=>'numeric'

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
            if($lang == "_ar"){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);


        }

        $key = null;$type = null;$loc = null;$sort = null;$sortCondtion = null;
        $total = array();
        $search = array();
        $keywordArr = array();


        if ($request->has('keyword')) {
            $key = $request->input('keyword');
            $searchEn = ['course_name','LIKE','%'.$key.'%'];
            $searchAr = ['course_name_ar','LIKE','%'.$key.'%'];
            array_push($total,$searchEn);
            array_push($keywordArr,$searchAr);



        }
        if ($request->has('course_type')) {
            $type = $request->input('course_type');
            $search = ['course_type_id','=',$type];
            array_push($total,$search);
            array_push($keywordArr,$search);



        }
        if ($request->has('international_or_local')) {
            $loc = $request->input('international_or_local');
            $search = ['local_or_global','=',$loc];
            array_push($total,$search);
            array_push($keywordArr,$search);

        }


        if ($request->has('city_id')) {
            $loc = $request->input('city_id');
            $search = ['city_id','=',$loc];
            array_push($total,$search);
            array_push($keywordArr,$search);

        }

        if ($request->has('location_id')) {
            $loc = $request->input('location_id');
            $search = ['location_id','=',$loc];
            array_push($total,$search);
            array_push($keywordArr,$search);

        }

        if ($request->has('weeks_number')) {

            $loc = $request->input('weeks_number');
            $search = ['weeks_number','>=',$loc];
            array_push($total,$search);
            array_push($keywordArr,$search);

        }



        //if sort by price exists it takes the highest priority
        $sortCondtion = new coursesApiModel;

        if ($request->has('sort_by_price')) {

            $sort = $request->input('sort_by_price');
            if($sort == 1){
                $sortCondtion->cloumn = 'course_price';
                $sortCondtion->sortBy = 'ASC';
            }
            if($sort == 2){
                $sortCondtion->cloumn = 'course_price';
                $sortCondtion->sortBy = 'DESC';
            }

        }
        //if sort by price not exists
        else{
                //if sort by rate is exists
                if ($request->has('sort_by')) {
                $sort = $request->input('sort_by');
                if($sort == 1){
                    $sortCondtion->cloumn = 'avg_rate_c';
                    $sortCondtion->sortBy = 'ASC';
                }
                if($sort == 2){
                    $sortCondtion->cloumn = 'avg_rate_c';
                    $sortCondtion->sortBy = 'DESC';
                }
            }else{
                //default if there is no sorting condtions
                $sortCondtion->cloumn = 'avg_rate_c';
                $sortCondtion->sortBy = 'DESC';

            }
        }





        //    return $orSearch;
        $photo_path = URL::to('/').'/storage/images/courses/';

        if($fitleration =  coursesApiModel::getGlobalSearch($total,$keywordArr,$sortCondtion)){

            $total_records = array();
            $record = array();
            $pagination = array();
             if($fitleration->isEmpty()){
                if($lang == "_ar"){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);

            }

            foreach ($fitleration as $key => $value) {

                if(coursesApiModel::checkWish($value->course_id,$STID)){
                    $wish = true;
                }else{
                    $wish = false;
                }

                $record = [
                                "id"            =>intval($value->course_id),
                                "liked"         =>$wish,
                                "image"         =>$photo_path.$value->course_photo,
                                "rate"          =>$value->avg_rate_c,
                                "institute"     =>$value->{'institute_name'.$lang},
                                "title"         =>$value->{'course_name'.$lang},
                                "price"         =>$value->course_price

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
            if($pagination == null){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
            }
            return response()->json(['success'=>true,"result"=>["courses"=>$total_records,"pagination"=>$pagination]],200);



        }else{

            if($lang == "_ar"){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد نتائج بحث","details"=>array()]],401);
            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No search result","details"=>array()]],401);
        }

        // return $request->all();





    }

    public function getPageCourseSearch(Request $request)
    {
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);  
        $lang = parent::detectLang($request);

       
        
        if($allCourseTypes = coursesApiModel::getAllCourseTypes($lang)){

            $total_records = array();
            $record = array();
    
            foreach ($allCourseTypes  as $key => $value) {
    
                $record = [
                    "course_type_id"=>$value->{'course_type_id'},
                    "course_type_name"=>$value->{'course_type_name'.$lang},
    
                ];
                array_push($total_records,$record);
                
             }
    
    
            return response()->json(['success'=>true,"result"=>["courses_types"=>$total_records]],200);
    
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
        }


    }


    public function getPageGlobalSearch(Request $request)
    {
        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);  
        $lang = parent::detectLang($request);

       
        
        if($allCourseTypes = coursesApiModel::getAllCourseTypes($lang)){

            $total_records = array();
            $record = array();
    
            foreach ($allCourseTypes  as $key => $value) {
    
                $record = [
                    "course_type_id"=>$value->{'course_type_id'},
                    "course_type_name"=>$value->{'course_type_name'.$lang},
    
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


                if($allCountries= coursesApiModel::getallCountries($lang)){


                    $allInstitutesCountires = array();
                    $record = array();
            
                    foreach ($allCountries  as $key => $value) {
            
                        $record = [
                            "location_id"=>$value->{'location_id'},
                            "country"=>$value->{'country'.$lang},
            
                        ];
                        array_push($allInstitutesCountires,$record);
                        
                    }
    
                    return response()->json(['success'=>true,"result"=>["search_data"=>["courses_types"=>$total_records,"cities"=>$allInstitutesCitites,"countries"=>$allInstitutesCountires]]],200);
                
                }else{
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
                }


            
            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
            }
    
           
    
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
        }


    }


    

}
