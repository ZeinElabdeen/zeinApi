<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    public function forgetPassword () {
        return view('dashboard.admin.forgetPassword');
    }

    public function forgetPasswordPost () {
//        dd(request()->all());
        $this->validate(request(),['email' => 'required|email|exists:admins,email|max:191',]);
        $token = $this->randToken();
        $admin = Admin::where('email',request()->email)->first();
        $admin->reset_password_code = $token;
        $admin->save();
        $sendMail = $this->resetPasswordMail(request()->email,$token);
        if (!$sendMail){
            return back()->with('error','خطأ لم يتم الإرسال');
        }

        return redirect('admin/login')->with('success','تم إرسال رابط إستعادة كلمة المرور');

    }

    public function resetPassword ($email, $token) {
        validator::make(request()->all(),
            ['email' => $email, 'token'=> $token],
            [
                'email' => 'required|email,exists:admins,email',
                'token' => 'required|email,exists:admins,reset_password_code',
            ]
        )->validate();
        session()->put('resetEmail',$email);
        session()->put('resetToken',$token);

        return view('dashboard.admin.resetPassword');
    }

    public function resetPasswordPost () {
//        dd(request()->all());
        if (!session()->has('resetEmail') || !session()->has('resetToken')) {
            session()->flash('message','انتهت صلاحية هذا الرابط');
            return redirect('admin/login');
        }
        $email = session()->get('resetEmail');
        $token = session()->get('resetToken');
        $admin = Admin::where('email',$email)->where('reset_password_code',$token)->first();
        if (!$admin) {
            return back()->with('message','البيانات غير صحيحة');
        }
        validator::make(request()->all(),[
            'password' => 'required|confirmed|max:191:min:8',
            'password_confirmation' => 'required',
        ])->validate();
        $admin->password = Hash::make(request()->password);
        $admin->reset_password_code = null;
        $admin->save();
        session()->forget('resetEmail');
        session()->forget('resetToken');
        return redirect('/admin/login')->with('success','تم تحديث كلمة المرور بنجاح');

    }

    protected function randToken () {
        $token = md5(rand(1000000000,9999999999));
        return (Admin::where('reset_password_code',$token)->first())?$this->randToken():$token;

    }
    protected function resetPasswordMail ($email,$token) {

        $data = array( "body" => request()->root()."/admin/reset-password/".$email."/".$token);

        Mail::send('dashboard.admin.resetPasswordEmail', $data, function($message) use ( $email) {
            $message->to($email)
                ->subject(' Reset Password ');
            $message->from('no-reply@saudi-clubs.com','saudi-clubs.com');
        });
        if (Mail::failures()){
            return false;
        }
        return true;
    }
}
