<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function get () {
        return view('dashboard.admin.changePassword');
    }

    public function post () {

        $this->validate(request(),[
            'old_password'     => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed|max:255',

        ]);

        if(Hash::check(request()->old_password,auth()->guard('admin')->user()->password))
        {
            $admin = Admin::where('id',auth()->guard('admin')->user()->id)->first();
            $admin->password = Hash::make(request()->password);
            $save = $admin->save();
            if (!$save) {
                session()->flash('error','خطأ في حفظ البيانات الجديدة');
                return redirect()->back();
            }
            session()->flash('success','تم تحديث كلمة المرور بنجاح');
            return redirect('/dashboard');
        }
        else
        {
            session()->flash('error','كلمة المرور غير متطابقة');
            return redirect()->back();
        }
    }
}
