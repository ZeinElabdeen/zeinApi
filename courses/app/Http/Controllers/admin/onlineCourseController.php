<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\onlineCourseModel;
use App\models\admin\instituteModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class onlineCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allOnline = onlineCourseModel::allCourses();
        return view('admin.OnlineCourses.allOnlineCourses',[
            'allCourses'=> $allOnline
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
        $institute = instituteModel::allInstitute();
        return view('admin.OnlineCourses.addOnlineCourse',[
            'institute'=>$institute
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
            'online_course_name'=>'required',
            'online_course_name_ar'=>'required',
            'online_course_details'=>'required',
            'online_course_details_ar'=>'required',
            'online_course_photo'=>'required|image|mimes:jpeg,png,jpg|max:1048',
            'institute_id'=>'required|numeric',
            'online_course_link'=>'required'
        ],[
            'online_course_name.required'=>'name is required',
            'online_course_name_ar.required'=>'name in arabic is required',
            'online_course_details.required'=>'details is required',
            'online_course_details_ar.required'=>'details in arabic is required',
            'online_course_photo.required'=>'image required',
            'institute_id.required'=>'institute required',
            'online_course_link.required'=>'link required'
        ]);

        $data = new onlineCourseModel;
        $file_name= time() . '.' . $request->online_course_photo->extension();
        $request->online_course_photo->move(storage_path('app/public/images/onlineCourse'), $file_name);
        $data->online_course_photo = $file_name;

        $data->online_course_name = $request->online_course_name;
        $data->online_course_name_ar = $request->online_course_name_ar;
        $data->online_course_details = $request->online_course_details;
        $data->online_course_details_ar = $request->online_course_details_ar;
        $data->online_course_link = $request->online_course_link;
        $data->institute_id = $request->institute_id;

        onlineCourseModel::addCourseOnline($data);
            return redirect()->back()->with('Success','You have Successfully Added New Institute');
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
        $institute = instituteModel::allInstitute();
        $allOnlineCourses = onlineCourseModel::onlineCoursesdetails($id);
        return view('admin.OnlineCourses.onlineDetails',[
            'allonlineCourse' => $allOnlineCourses,
            'institute' =>$institute
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
        //
        $request->validate([
            'online_course_photo'=>'image|mimes:jpeg,png,jpg|max:1048',
        ]);
        $data = $request->except('_token','_method');
        if($request->has('online_course_photo')){
            $file_name= time() . '.' . $request->online_course_photo->extension();
            $request->online_course_photo->move(storage_path('app/public/images/onlineCourse'), $file_name);
            $data['online_course_photo'] = $file_name;
            $oldPhotoName = onlineCourseModel::getOnlineCoursePhoto($id);
                if(Storage::delete('public/images/onlineCourse/'.$oldPhotoName)){
                    onlineCourseModel::updateOnlineCourse($data,$id);
                }
        }else{
            onlineCourseModel::updateOnlineCourse($data,$id);
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
        $photoName = onlineCourseModel::deleteOnlineCourse($id);
        if(Storage::delete('public/images/onlineCourse/'.$photoName)){
            return redirect()->back()->with("Success","You Have Successfully Removed course number : ".$id);
        }
        return redirect()->back()->with("Error","Please try again");
    }


}
