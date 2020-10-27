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
                'username' => 'required|string',
                'email'    => 'required|email|unique:admins,email',
                'password' => 'required|string|confirmed',
                'password_confirmation' => 'required',
            ]);
        $create = Admin::create([
            'email'    => request()->email,
            'username'    => request()->username,
            'password' => Hash::make(request()->password),
        ]);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return redirect('dashboard')->with('success','تم إضافة المدير بنجاح');
    }

    public function delete ($id) {
        validator::make(['id'=>$id],
            [
                'id' => 'required|integer|exists:admins,id',
            ])->validate();
        $admin = Admin::find($id);
        if (!$admin->delete()) {
            return back()->with('error', 'حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المدير');
    }
}
