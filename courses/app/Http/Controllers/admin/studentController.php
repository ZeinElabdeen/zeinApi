<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\studentModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student = studentModel::allstudent();
        return view('admin.student.allStudent',[
            'students'=>$student
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
        return view('admin.student.addStudent');
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
            'student_name'=>'required',
            'student_email'=>'required|email|unique:students',
            'student_phone'=>'required|numeric|unique:students',
            'student_password'=>'required|min:8|max:20',
        ],[
            'student_name.required'=>'name is required',
            'student_email.required'=>'email is required',
            'student_phone.required'=>'phone is required',
            'student_password.required'=>'required',
        ]);

        if($request->student_passport_name != null ||$request->student_passport_number != null || $request->has('passport_photo')){
            $request->validate([
                'student_passport_name'=>'required',
                'student_passport_number'=>'required|numeric',
                'passport_photo'=>'required|image|mimes:jpeg,png,jpg|max:1048',
            ]);
        }

        $data = new studentModel;
        if($request->has('passport_photo')){
            $file_name= time() . '.' . $request->passport_photo->extension();
            $request->passport_photo->move(storage_path('app/public/images/passports'), $file_name);
            $data->passport_photo = $file_name;

            $data->student_name = $request->student_name;
            $data->student_email = $request->student_email;
            $data->student_phone = $request->student_phone;
            $data->student_password = bcrypt($request->student_password);
            $data->student_passport_name = $request->student_passport_name;
            $data->student_passport_number = $request->student_passport_number;
        }else{
            $data->student_name = $request->student_name;
            $data->student_email = $request->student_email;
            $data->student_phone = $request->student_phone;
            $data->student_password = bcrypt($request->student_password);
        }

        studentModel::addStudent($data);

            return redirect()->back()->with('Success','You have Successfully Added New Student');

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
        $profile = studentModel::profileStudent($id);
        $courses = studentModel::studentCourses($id);
        $rateCourse = studentModel::rateOfStudent($id);
        $wishlist = studentModel::studentWishlist($id);
        $notes = studentModel::studentNote($id);
        return view('admin.student.studentProfile',[
            'profile'=>$profile,
            'courses'=>$courses,
            'rates'=>$rateCourse,
            'wishlist'=>$wishlist,
            'notes'=>$notes
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

        // echo('<pre>');print_r($request->all());echo('<pre>');

        $request->validate([
            "student_name"=>"required",
            'student_email'=>'required|email',
            'student_phone'=>'required|min:13|max:20',
            // 'student_password'=>'required|min:8|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            "student_passport_name"     =>"required|max:50",
            "student_passport_number"   =>"required|numeric",
            "passport_photo"            =>"image",

        ]);


        $STData = $request->except('_token','_method');


        //case of changing photo
        if($request->has('passport_photo')){
            $request->validate([
                'old_photo_name'            => 'required',

            ]);
            //move photo to server
            if($request->old_photo_name !== 'default.jpg'){
                Storage::delete('public/images/passports/'.$request->old_photo_name);
            }
            $file_name= time() . '.' . $request->passport_photo->extension();
            $request->passport_photo->move(storage_path('app/public/images/passports'), $file_name);
            $STData['passport_photo'] = $file_name;

            try {

                studentModel::updateProfile($STData,$id);
                return redirect()->back()->with('Success','Successfully updated');
            }
            catch (QueryException $e) {
                $errorCode = $e->getCode();
                $errorMessage = $e->getMessage();
                if($errorCode == 23000){
                    if (strpos($errorMessage, "key 'student_passport_number'") !== false) {
                        return redirect()->back()->with('Error','Paasport Number is already exists');
                    }if(strpos($errorMessage, "key 'student_phone'") !== false){
                            return redirect()->back()->with('Error','Phone Number is already exists');
                    }if(strpos($errorMessage, "key 'student_email'") !== false){
                        return redirect()->back()->with('Error','Email  is already exists');
                    }
                }
            }
        }
        // in case the old photo and didn't change photo
        $STData['passport_photo']= $request->old_photo_name;
        try {
            studentModel::updateProfile($STData,$id);
            return redirect()->back()->with('Success','Successfully updated');
        }
        catch (QueryException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            if($errorCode == 23000){
                if (strpos($errorMessage, "key 'student_passport_number'") !== false) {
                    return redirect()->back()->with('Error','Paasport Number is already exists');
                }
                if(strpos($errorMessage, "key 'student_phone'") !== false){
                    return redirect()->back()->with('Error','Phone Number is already exists');
                }
                if(strpos($errorMessage, "key 'student_email'") !== false){
                    return redirect()->back()->with('Error','Email  is already exists');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $photoName = studentModel::deleteStudent($id);
        if($photoName == 'default.jpg'){
            return redirect()->back()->with("Success","You Have Successfully Removed student number : ".$id);

        }else{
            if(Storage::delete('public/images/passports/'.$photoName)){
                return redirect()->back()->with("Success","You Have Successfully Removed student number : ".$id);
            }
            return redirect()->back()->with("Success","You Have Successfully Removed student without photo ");
        }



    }
    public function studentStatus($id,$st)
    {

        // echo ' id is '.$id.' status before is '.$st;
        // echo ' id is '.$id.' status after is '.!$st;
        studentModel::STStatus($id,intval(!$st));
        return redirect()->back();
    }

    public function addNote(Request $request)
    {
        $data['note_photo'] = $request->note_photo_model;
        $data['note_details'] = $request->note_details_model;
        $data['student_id'] = $request->student_id;

            $valid = validator::make($data,[
                // 'note_photo'=>'image|mimes:jpeg,png,jpg|max:10240',
                "note_details"=>"required",
            ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid,'addnote')->withInput();
        }

        if($request->has('note_photo_model')){
            $file_name= time() . '.' . $request->note_photo_model->extension();
            $request->note_photo_model->move(storage_path('app/public/images/notes'), $file_name);
            $data['note_photo'] = $file_name;

            studentModel::insertNote($data);
            return redirect()->back()->with('Success','succefully add note');
        }

            studentModel::insertNote($data);
            return redirect()->back()->with('Success','succefully add note');
    }

    public function editNote(Request $request,$STID,$note_id)
    {
        $request->validate([
            'note_details'=>"required",
        ]);
        $data = $request->except('_token');

        if($request->has('note_photo')){
            $request->validate([
                'note_photo'=>"required|image|mimes:jpeg,png,jpg|max:10240",
            ]);
            $file_name= time() . '.' . $request->note_photo->extension();
            $request->note_photo->move(storage_path('app/public/images/notes'), $file_name);
            $data['note_photo'] = $file_name;
            if($oldPhotoName = studentModel::updateNote($STID,$note_id,$data)){
                if($oldPhotoName != 'default.jpg'){
                    if(Storage::delete('public/images/notes/'.$oldPhotoName)){
                        return redirect()->back()->with('Success','You have successfully edit your note');
                    }
                }else{
                    return redirect()->back()->with('Success','You have successfully edit your note');
                    }
            }else{
                return redirect()->back()->with('Success','You have successfully edit your note');
            }
        }
        studentModel::updateNote($STID,$note_id,$data);
        return redirect()->back();
    }

    public function deleteNote(Request $request,$STID,$note_id)
    {
        $photoName = studentModel::deleteNote($STID,$note_id);
        if($photoName != 'default.jpg'){
            if(Storage::delete('public/images/notes/'.$photoName)){
                return redirect()->back()->with('Success','Note has been successfully deleted');
            }
            return redirect()->back()->with('Success','Note has been successfully deleted');
        }
    }
}
