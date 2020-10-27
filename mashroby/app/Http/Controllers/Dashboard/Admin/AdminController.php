<?php

namespace App\Http\Controllers\Dashboard\Admin;
use Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index () {
        $data = Admin::all();
        return view('dashboard.admin.index',compact('data'));
    }
    public function create () {

        return view('dashboard.admin.create');
    }
    public function store () {
        $this->validate(request(),
            [
                'username' => 'required|string|min:3',
                'email'    => 'required|email|unique:admins,email',
                'password' => 'required|string|confirmed',
            ]);
        $create = Admin::create([
            'username'    => request()->username,
            'email'    => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return redirect('dashboard')->with('success','تم إضافة المدير بنجاح');
    }

    public function delete () {
        $this->validate(
            request(),
            [
                'id' => 'required|integer|exists:admins,id',
            ]);
        $admin = Admin::find(request()->id);
        if (!$admin->delete()) {
            return back()->with('error', 'حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المدير');
    }

    public function edit ($id) {
       validator::make(['id'=>$id],
           [
               'id' => 'required|integer|exists:admins,id',
           ])->validate();
       $data = Admin::find($id);
       return view('dashboard.admin.edit',compact('data'));
   }

    public function update () {
        $this->validate(request(),
            [
                'id' => 'required|integer|exists:admins,id',
                'username' => 'required|string|min:3',
                'email'    => 'required|email',
            ]);
        if(isset(request()->password))
        {
          $this->validate(request(),
              [
                'password' => 'required|string|confirmed|min:8',
                'password_confirmation' => 'required',
              ]);
        }
        $user = Admin::find(request()->id);
        if(isset(request()->password))
        {
          $user->password = Hash::make(request()->password);
        }
        $user->username = request()->username;
        $user->email = request()->email;

        $update = $user->update($user->toArray());
        if (!$update) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل بيانات المدير بنجاح');
    }

}
