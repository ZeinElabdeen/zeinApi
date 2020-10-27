<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\indexModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('admin.dashboard');
        return redirect('/admin');
    }

    public function getProfile($id =  null)
    {
        if($id == null){
            $id =  Auth::user()->id;
        }
        $admin = indexModel::getProfile($id);
        return view('auth.register',[
            'admin' => $admin,
        ]);
    }
    public function updateProfile(Request $request,$id = null)
    {
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|email',
            'phone'=> 'required',
            
        ]);
        if($id == null){
            $id =  Auth::user()->id;
        }
        $data = $request->except('_token');
        indexModel::updateData($data,$id);
        return redirect()->back()->with('Success','Information has been updated');

    }
    public function getRegister()
    {
        return view('auth.register');
    }
    public function Register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|email',
            'phone'=> 'required',
            'password'=>'required|required_with:password_confirmation|same:password_confirmation|min:8|max:20',
            'password_confirmation'=>'required',
            
        ]);
        $data = $request->except('_token','password_confirmation');
        $data['password'] = bcrypt($data['password']);
        $data['created_at'] = date("Y-m-d H:i:s");
        
        indexModel::insertData($data);
        return redirect()->back()->with('Success','New admin has been inserted');

    }
    public function getAllAdmins()
    {
        $admins = indexModel::getAllAdmins();
        return view('auth.all_admins',[
            'admins' => $admins,
        ]);
    }

    public function deleteAdmin($id)
    {

        indexModel::deleteAdmin($id);
        return redirect()->back()->with('Success','You have deleted admin number: '.$id);

    }

    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("Error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("Error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        // $user->password = bcrypt($request->get('new-password'));
        $data['password'] = bcrypt($request->get('new-password'));
        $id = Auth::user()->id;

        indexModel::updatePassword($data,$id);

        return redirect()->back()->with("Success","Password changed successfully !");
    }

    
}
