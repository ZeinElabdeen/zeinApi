<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\coursesModel;
use App\models\admin\instituteModel;
use Illuminate\Support\Facades\Storage;

class coursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCourses = coursesModel::getAllCourses();
        return view('admin.courses.allCourses',[
            'allCourses' => $allCourses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseTypes =coursesModel::getAllCourseTypes();
        $institutes = instituteModel::allInstitute();
        return view('admin.courses.addCourses',[
            'courseTypes'=>$courseTypes,
            'institutes'=>$institutes,
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
            'course_name'           => 'required|min:2',//regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/
            'course_name_ar'        => 'required|min:2',
            'institute_id'          => 'required|numeric|exists:institutes',
            'course_type_id'        => 'required|numeric|exists:course_type',
            'weeks_number'          => 'required|numeric',
            'local_or_global'       => 'required|numeric|between:1,2',
            'course_photo'         => 'required|image',
            'course_details'        => 'required',
            'course_details_ar'        => 'required',

            'course_price'          => 'required|numeric|min:0|max:50000',
            'book_fees'             => 'required|numeric|min:0|max:50000',
            'living_fees'           => 'required|numeric|min:0|max:50000',
            'mail_fees'             => 'required|numeric|min:0|max:50000',
            'summer_fees'           => 'required|numeric|min:0|max:50000',
            'registration_fees'     => 'required|numeric|min:0|max:50000',
            'tax_fees'              => 'required|numeric|between:0,0.99',
            

            'airport_rec_price'     => 'required',
            'airport_rec_name'     => 'required|min:3|max:300',
            'airport_rec_name_ar'     => 'required|min:3|max:300',

            'medical_insurance_price'     => 'required',
            'medical_insurance_name'     => 'required|min:3|max:300',
            'medical_insurance_name_ar'     => 'required|min:3|max:300',
        ]);
        

        // echo('<pre><br>'); print_r($request->all()); echo('<pre><br>'); return 'ok';

        $courseData = $request->except('_token','_method','living_id','living_name','living_name_ar','living_price','airport_rec_price','medical_insurance_price','medical_insurance_name','medical_insurance_name_ar','airport_rec_name','airport_rec_name_ar','isResidence');
        $insuranceData = $request->only('medical_insurance_price','medical_insurance_name','medical_insurance_name_ar');
        $receptionData = $request->only('airport_rec_price','airport_rec_name','airport_rec_name_ar');
        // return $livingData;
            

        $file_name= time() . '.' . $request->course_photo->extension();
        $request->course_photo->move(storage_path('app/public/images/courses'), $file_name);
        // $photoURL =url('storage\App\public\images\institutes'.$file_name);
        $courseData['course_photo'] = $file_name;
        $course_id = coursesModel::insertCourse($courseData);
        

        $insuranceData['course_id'] = $course_id;
        coursesModel::insertInsurance($insuranceData);

        $receptionData['course_id'] = $course_id;
        coursesModel::insertReception($receptionData);


        if($request->isResidence == 1){
            //
        }else{
                 
                $request->validate([
                    
                    'living_name'           => 'required|array',
                    'living_name.*'           => 'required',
                    'living_name_ar'        => 'required|array',
                    'living_name_ar.*'        => 'required',
                    'living_price'          => 'required|array',
                    'living_price.*'          => 'required|numeric',
                ]);
            
                $livingData = $request->only('living_id','living_name','living_name_ar','living_price');
                // return $livingData;
                $residenceData = array();
                $livingCount = count($livingData['living_name']);
                for ($i=0; $i < $livingCount ; $i++) {
                    $residenceData['living_name'] = $livingData['living_name'][$i];
                    $residenceData['living_name_ar'] = $livingData['living_name_ar'][$i];
                    $residenceData['living_price'] = $livingData['living_price'][$i];
                    $residenceData['course_id'] = $course_id;
                    // return $residenceData;
                    coursesModel::insertLiving($residenceData);
                }
        }
        
        

        return redirect()->back()->with('Success','Successfully updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courseDetails = coursesModel::getCourseDetails($id);
        $courseResidences = coursesModel::getCourseResidences($id);
        $courseReceptions = coursesModel::getCourseReceptions($id);
        $courseInsurances = coursesModel::getCourseInsurances($id);
        $courseRates = coursesModel::getCourseRates($id);
        $courseAvgRates =coursesModel::getratecourse($id);
        $courseTypes =coursesModel::getAllCourseTypes();
        $institutes = instituteModel::allInstitute();
        // return $courseResidences;
        return view('admin.courses.courseDetails',[
            'courseDetails'=>$courseDetails,
            'courseResidences'=>$courseResidences,
            'courseReceptions'=>$courseReceptions,
            'courseInsurances'=>$courseInsurances,
            'courseRates'=>$courseRates,
            'courseAvgRates'=>$courseAvgRates,
            'courseTypes'=>$courseTypes,
            'institutes'=>$institutes,
           
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id)
    {
      

        $request->validate([
            'course_name'           => 'required|min:2',//regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/
            'course_name_ar'        => 'required|min:2',
            'institute_id'          => 'required|numeric|exists:institutes',
            'course_type_id'        => 'required|numeric|exists:course_type',
            'weeks_number'          => 'required|numeric',
            'local_or_global'       => 'required|numeric|between:1,2',

            'course_price'          => 'required|numeric|min:0|max:50000',
            'book_fees'             => 'required|numeric|min:0|max:50000',
            'living_fees'           => 'required|numeric|min:0|max:50000',
            'mail_fees'             => 'required|numeric|min:0|max:50000',
            'summer_fees'           => 'required|numeric|min:0|max:50000',
            'registration_fees'     => 'required|numeric|min:0|max:50000',
            'tax_fees'              => 'required|numeric|between:0,0.99',
            'course_details'        => 'required',
            
            'airport_rec_price'     => 'required',
            'medical_insurance_price'     => 'required',
        ]);
        
        $courseData = $request->except('_token','_method','living_id','living_name','living_name_ar','living_price','airport_rec_price','medical_insurance_price');
        $livingData = $request->only('living_id','living_name','living_name_ar','living_price');
        $insuranceData = $request->only('medical_insurance_price');
        $receptionData = $request->only('airport_rec_price');

        //   echo('<pre><br>'); print_r($request->all()); echo('<pre><br>');return 'ok';

          if($request->has('course_photo')){

            $file_name= time() . '.' . $request->course_photo->extension();
            $request->course_photo->move(storage_path('app/public/images/courses'), $file_name);
            
            // $photoURL =url('storage\App\public\images\institutes'.$file_name);
            $courseData['course_photo'] = $file_name;

            $oldPhotoName = coursesModel::getCoursePhoto($course_id);
            // echo('<pre><br>'); print_r($courseData); echo('<pre><br>');return $oldPhotoName;

            if(Storage::delete('public/images/courses/'.$oldPhotoName)){
                coursesModel::updateCourse($courseData,$course_id);
            }  


          }else{
            coursesModel::updateCourse($courseData,$course_id);
          }
        // if($request->has('course_name')){
        // }
        if($request->has('medical_insurance_price')){
            coursesModel::updateInsurance($insuranceData,$course_id);
        }
        if($request->has('airport_rec_price')){
            coursesModel::updateReception($receptionData,$course_id);
        }
        if($request->has('living_name')){
            $request->validate([
            'living_id'             => 'required',
            'living_name'           => 'required',
            'living_name_ar'        => 'required',
            'living_price'          => 'required',

            ]);


            $livingCount = count($livingData['living_name']);
            for ($i=0; $i < $livingCount ; $i++) {
                coursesModel::updateLiving($livingData['living_id'][$i],$livingData['living_name'][$i],$livingData['living_name_ar'][$i],$livingData['living_price'][$i],$course_id);
            }
        }
        

        return redirect()->back()->with('Success','Successfully updated');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $photoName = coursesModel::deleteCourse($id);
        if(Storage::delete('public/images/courses/'.$photoName)){
            return redirect()->back()->with("Success","You Have Successfully Removed course number : ".$id);
        }  
        return redirect()->back()->with("Error","Please try again");
    }
}
