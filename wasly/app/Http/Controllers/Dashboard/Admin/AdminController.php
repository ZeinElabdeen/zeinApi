<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;

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
                'role' => 'required|string|in:1,2',
                'email'    => 'required|email|unique:admins,email',
                'password' => 'required|string|confirmed',
            ]);
        $create = Admin::create([
            'username'    => request()->username,
            'email'    => request()->email,
            'role'    => request()->role,
            'password' => Hash::make(request()->password),
        ]);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return redirect('dashboard')->with('success','تم إضافة المدير بنجاح');
    }

    public function delete ($id) {

      Validator::make(['id' => $id],['id' => 'required|integer|exists:admins,id'])->validate();
        $admin = Admin::find($id)->delete();

        if (!$admin) {
            return back()->with('error', 'حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المدير');
    }
}
