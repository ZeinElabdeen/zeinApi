<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\courseTypesModel;

class courseTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCourseTypes = courseTypesModel::getAllCourseTypes();
        return view('admin.courseTypes.allCourseTypes',[
            'allCourseTypes' => $allCourseTypes
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courseTypes.courseTypesDetails',[
            'add'=>1,
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
            'course_type_name'=>'required',
            'course_type_name_ar'=>'required',
        ]);

        $data = $request->except('_token','_method');
        courseTypesModel::insertCourseType($data);
        return redirect()->back()->with('Success','Infromation has been updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courseType = courseTypesModel::getCourseType($id);
        return view('admin.courseTypes.courseTypesDetails',[
            'courseType' => $courseType,
            'add'=>0,
        ]);
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
        $request->validate([
            'course_type_name'=>'required',
            'course_type_name_ar'=>'required',
        ]);

        $data = $request->except('_token','_method');
        courseTypesModel::editCourseType($id,$data);
        return redirect()->back()->with('Success','Infromation has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(courseTypesModel::deleteCourseType($id)){
            return redirect()->back()->with("Success","You Have Successfully Removed course Type number : ".$id);
        }
        return redirect()->back()->with("Error","Please try again");
    }
}
