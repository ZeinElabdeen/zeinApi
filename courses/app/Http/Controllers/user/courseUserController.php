<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\models\user\courseUserModel;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class courseUserController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'page'=>'numeric'
        ]);
        
        $lang = parent::detectUserLang();

        $allCourses = courseUserModel::getAllCourses();
        $totalCourses = [];
        foreach ($allCourses as $key => $value) {
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
                'liked'                 =>$wish
            ];        
            array_push($totalCourses , $recordCourse);
        }
        // return $totalCourses;

        $CourseTypes = courseUserModel::getAllCourseTypes();
        $totalCourseTypes = [];
        foreach ($CourseTypes as $key => $value) {
            $recordCourse = [
                "course_type_id"             =>intval($value->course_type_id),
                "course_type_name"           =>$value->{'course_type_name'.$lang},
            ];        
            array_push($totalCourseTypes , $recordCourse);
        }
        

        if($lang == '_ar'){
            return view('user.ar.allCourses',[
                'allCourses' => $allCourses,
                'totalCourses'=>$totalCourses,
                'totalCourseTypes'=>$totalCourseTypes,

            ]);
        }else{
            return view('user.en.allCourses',[
                'allCourses' => $allCourses,
                'totalCourses'=>$totalCourses,
                'totalCourseTypes'=>$totalCourseTypes,


            ]);
        }
    }

    public function courseDetails(Request $request,$id)
    {
        $lang = parent::detectUserLang();
        
        $data['course_id'] = $id;
            $valid = validator::make($data,[
                'course_id'=>'required|numeric|exists:courses'
        ]);

        if($valid->fails()){
            abort(404);            
        }

        $courseDetails = courseUserModel::getCourseDetails($id);

        $avg_rate_i = courseUserModel::getInstituteAVG($courseDetails->institute_id);
        $countRateInstitute = courseUserModel::getCountRateInst($courseDetails->institute_id);
        $countRateCourse = courseUserModel::getCountRateCourse($courseDetails->course_id);

        $livings = courseUserModel::getCourseLiving($courseDetails->course_id);
        
        $totalLivings = [];
        foreach ($livings as $key => $value) {
            $recordCourse = [
                "living_id"             =>intval($value->living_id),
                "living_name"           =>$value->{'living_name'.$lang},
                "living_price"           =>$value->living_price,
            ];        
            array_push($totalLivings , $recordCourse);
        }

        
        $receptions = courseUserModel::getCourseReciption($courseDetails->course_id);
        $totalReceptions = [];
        foreach ($receptions as $key => $value) {
            $recordCourse = [
                "airport_rec_id"                    =>intval($value->airport_rec_id),
                "airport_rec_name"                  =>$value->{'airport_rec_name'.$lang},
                "airport_rec_price"                 =>$value->airport_rec_price,
            ];        
            array_push($totalReceptions , $recordCourse);
        }


        $insurances = courseUserModel::getCourseInsurance($courseDetails->course_id);
        $totalInsurances = [];
        foreach ($insurances as $key => $value) {
            $recordCourse = [
                "medical_insurance_id"                      =>intval($value->medical_insurance_id),
                "medical_insurance_name"                  =>$value->{'medical_insurance_name'.$lang},
                "medical_insurance_price"                 =>$value->medical_insurance_price,
            ];        
            array_push($totalInsurances , $recordCourse);
        }
        // return $avg_rate_i;
        $courseDetails->institute_name          =$courseDetails->{'institute_name'.$lang};
        $courseDetails->course_name             =$courseDetails->{'course_name'.$lang};
        $courseDetails->course_details          =$courseDetails->{'course_details'.$lang};
        $courseDetails->institute_details       =$courseDetails->{'institute_details'.$lang};
        $courseDetails->avg_rate_i              =$avg_rate_i;
        $courseDetails->countRateInstitute      =$countRateInstitute;
        $courseDetails->countRateCourse         =$countRateCourse;

        if(courseUserModel::checkWish($courseDetails->course_id,Session()->get('user_id'))){
            $wish = true;
        }else{
            $wish = false;
        }
        $courseDetails->liked                   =$wish;
        

        if($lang == '_ar'){
            return view('user.ar.courseDetails',[
                'courseDetails' => $courseDetails,
                'totalLivings'=>$totalLivings,
                'totalReceptions'=>$totalReceptions,
                'totalInsurances'=>$totalInsurances,
            ]);
        }else{
            return view('user.en.courseDetails',[
                'courseDetails' => $courseDetails,
                'totalLivings'=>$totalLivings,
                'totalReceptions'=>$totalReceptions,
                'totalInsurances'=>$totalInsurances,


            ]);
        }
    }

    public function coursesSearch(Request $request)
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
            $searchEn = ['course_name','LIKE','%'.$key.'%'];
            $searchAr = ['course_name_ar','LIKE','%'.$key.'%'];
            array_push($total,$searchEn);
            array_push($keywordArr,$searchAr);


        }
        if(isset($request->course_type)){

            $valid = validator::make($request->all(),[
                'course_type'=>'numeric',
            ]);
            if($valid->fails()){
                abort(404);
            }

            $type = $request->input('course_type');
            $search = ['course_type_id','=',$type];
            array_push($total,$search);
            array_push($keywordArr,$search);



        }
        if(isset($request->local_or_global)){

            $valid = validator::make($request->all(),[
                'local_or_global'=>'numeric|min:1|max:2',
            ]);
            if($valid->fails()){
                abort(404);
            }

            $loc = $request->input('local_or_global');
            $search = ['local_or_global','=',$loc];
            array_push($total,$search);
            array_push($keywordArr,$search);

        }


        //if sort by price exists it takes the highest priority
        $sortCondtion = new courseUserModel;

        if(isset($request->price)){

            $valid = validator::make($request->all(),[
                'price'=>'numeric|min:1|max:2',
            ]);
            if($valid->fails()){
                abort(404);
            }

            $sort = $request->input('price');
            if($sort == 1){
                $sortCondtion->cloumn = 'course_price';
                $sortCondtion->sortBy = 'ASC';
            }
            if($sort == 2){
                $sortCondtion->cloumn = 'course_price';
                $sortCondtion->sortBy = 'DESC';
            }

        }else{
            //default if there is no sorting condtions
            $sortCondtion->cloumn = 'avg_rate_c';
            $sortCondtion->sortBy = 'DESC';

        }
        //if sort by price not exists
        // else{
        //         //if sort by rate is exists
        //         if ($request->has('sort_by')) {
        //         $sort = $request->input('sort_by');
        //         if($sort == 1){
        //             $sortCondtion->cloumn = 'avg_rate_c';
        //             $sortCondtion->sortBy = 'ASC';
        //         }
        //         if($sort == 2){
        //             $sortCondtion->cloumn = 'avg_rate_c';
        //             $sortCondtion->sortBy = 'DESC';
        //         }
        //     }else{
        //         //default if there is no sorting condtions
        //         $sortCondtion->cloumn = 'avg_rate_c';
        //         $sortCondtion->sortBy = 'DESC';

        //     }
        // }


        // return $keywordArr;            


        if($fitleration =  courseUserModel::getCourseSearch($total,$keywordArr,$sortCondtion)){

            $total_records = array();
            $record = array();
             if($fitleration->isEmpty()){
                if($lang == "_ar"){
                    return redirect('all-courses')->with('Error','لا توجد نتائج بحث');
                }
                return redirect('all-courses')->with('Error','No search result');

            }

            foreach ($fitleration as $key => $value) {

                if(courseUserModel::checkWish($value->course_id,Session()->get('user_id'))){
                    $wish = true;
                }else{
                    $wish = false;
                }

                $record = [
                                // "liked"         =>$wish,
                                "course_id"             =>intval($value->course_id),
                                "course_photo"          =>$value->course_photo,
                                "avg_rate_c"            =>$value->avg_rate_c,
                                "institute_name"        =>$value->{'institute_name'.$lang},
                                "course_name"           =>$value->{'course_name'.$lang},
                                "course_price"          =>floatval($value->course_price),
                                'course_details'        =>$value->{'course_details'.$lang},
                                'liked'                 =>$wish,

                ];
                array_push($total_records,$record);
                
                
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

            if($lang == '_ar'){
                return view('user.ar.allCourses',[
                    'allCourses' => $fitleration,
                    'totalCourses'=>$total_records,
                    'totalCourseTypes'=>$totalCourseTypes,

                ]);
            }else{
                return view('user.en.allCourses',[
                    'allCourses' => $fitleration,
                    'totalCourses'=>$total_records,
                    'totalCourseTypes'=>$totalCourseTypes,

    
                ]);
            }


        }else{

            if($lang == "_ar"){
                return redirect('all-courses')->with('Error','لا توجد نتائج بحث');
            }
            return redirect('all-courses')->with('Error','No search result');
        }

        // return $request->all();
        
    }

   
}
