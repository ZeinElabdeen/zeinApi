<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function get() {
        return view('dashboard.admin.login');
    }

    public function post() {
//       dd(request()->all());
        $this->validate(request(),[
            'email' => 'required|email|max:225',
            'password' => 'required|string|min:8|max:35',
        ]);


        $remember = request()->has('remember')? true:false;
        $credentials = array('email' => request()->email, 'password' => request()->password);
        $checkLogin = Auth::guard('admin')->attempt($credentials,$remember);
        if (!$checkLogin){
            session()->flash('error','البيانات غير صحيحة');
            return redirect('admin/login');

        }
        return redirect('/dashboard/home/');

    }

    public function logout () {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');
    }
}
