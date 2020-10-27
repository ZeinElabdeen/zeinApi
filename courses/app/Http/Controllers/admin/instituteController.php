<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\instituteModel;
use Illuminate\Support\Facades\Storage;


class instituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexdash()
    {
        //
        return view('admin.dashboard');
    }
    public function index()
    {
        //
        $institute = instituteModel::allInstitute();
        return view('admin.institutes.allInstitute',[
            'institutes'=>$institute
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $city = instituteModel::cities();
        $country =instituteModel::countries();
        return view('admin.institutes.addInstitute',[
            'city'=>$city,
            'country'=>$country
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
        //
        $request->validate([
            'institute_name'=>'required',
            'institute_name_ar'=>'required',
            'institute_details'=>'required',
            'institute_details_ar'=>'required',
            'institute_email'=>'required|email',
            'institutes_photo'=>'required|image|mimes:jpeg,png,jpg|max:1048',
            'location_id'=>'required|numeric',
            'city_id'=>'required|numeric'
        ]);

        $data = new instituteModel;
        $file_name= time() . '.' . $request->institutes_photo->extension();
        $request->institutes_photo->move(storage_path('app/public/images/institutes'), $file_name);
        // $photoURL =url('storage\App\public\images\institutes'.$file_name);
        $data->institutes_photo = $file_name;

        $data->institute_name = $request->institute_name;
        $data->institute_name_ar = $request->institute_name_ar;
        $data->institute_details = $request->institute_details;
        $data->institute_details_ar = $request->institute_details_ar;
        $data->location_id = $request->location_id;
        $data->city_id = $request->city_id;
        $data->institute_email = $request->institute_email;
            // return $data;
        instituteModel::addInstitute($data);
            return redirect('/admin/institute')->with('success','You have Successfully Added New Institute');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $course = instituteModel::courses($id);
        // $rate = instituteModel::getRateInstitute($id);
        $r_Institute = instituteModel::getRateInstitute($id);
        $rateUser = instituteModel::studentRate($id);
        $institute = instituteModel::instituteDetails($id);
        $onlineCourse = instituteModel::instituteCourseOnline($id);
        $instituteCourse = instituteModel::instituteCourse($id);
        $location = instituteModel::countries();
        $city = instituteModel::cities();
        return view('admin.institutes.instituteDetails',[
            'institutes'=>$institute,
            'Instrate'=>$r_Institute,
            'rateUser'=>$rateUser,
            'instCourse'=>$instituteCourse,
            'onlineCourse'=>$onlineCourse,
            'location'=>$location,
            'cities'=>$city,
            // 'course'=>$course
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
        // return $request->all();
        $request->validate([
            'institute_name'=>'required',
            'institute_name_ar'=>'required',
            'institute_details'=>'required',
            'institute_details_ar'=>'required',
            'institute_email'=>'required|email',
            'location_id'=>'required|numeric',
            'city_id'=>'required|numeric'
        ]);

            $instituteData = $request->only('institute_name','institute_name_ar','institute_details','institute_details_ar','location_id','city_id','institute_email');
            // return $instituteData;
            if($request->has('institutes_photo')){
                $request->validate([
                    'institutes_photo'=>'required|image|mimes:jpeg,png,jpg|max:1048',
                ]);
                $file_name= time() . '.' . $request->institutes_photo->extension();
                $request->institutes_photo->move(storage_path('app/public/images/institutes'), $file_name);
                $instituteData['institutes_photo'] = $file_name;
                $oldPhotoName = instituteModel::getInstitutePhoto($id);
                // return $oldPhotoName;
                if($oldPhotoName != 'default.jpg'){
                    if(Storage::delete('public/images/institutes/'.$oldPhotoName)){
                        instituteModel::updateInstitute($instituteData,$id);
                        return redirect()->back()->with('Success','Successfully updated');
                    }
                }else{
                    instituteModel::updateInstitute($instituteData,$id);
                    return redirect()->back()->with('Success','Successfully updated');
                }
                
            // return $instituteData;
          }
            instituteModel::updateInstitute($instituteData,$id);
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
        $photoName = instituteModel::deleteInst($id);
        if(Storage::delete('public/images/institutes/'.$photoName)){
            return redirect()->back()->with("Success","You Have Successfully Removed institute number : ".$id);
        }  
        return redirect()->back()->with("Error","Please try again");
       
    }

    // public static function rateInstitute($id)
    // {
    //     $r_Institute = instituteModel::getRateInstitute($id);

    //     // var_dump($r_course);
    //     return view('admin.institutes.instituteDetails',[
    //         'rateInstitute' => $r_Institute
    //     ]);
    // }
}
