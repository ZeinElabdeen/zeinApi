<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index () {

        $data = User::all();
      //  $user = 'المستخدمين';
        return view('dashboard.user.index',compact('data'));
    }
    // display memberships waiting for accept
    public function subscriptionRequests () {
        $data = User::where('type','2')->get();
        $user = 'طلبات الإشتراك';
        return view('dashboard.user.waitForActivation',compact('data','user'));
    }

    public function create () {

        return view('dashboard.user.create');
    }

    public function store () {
        $this->validate(request(),
            [
                'username' => 'required|string',
                'email'    => 'required|email|unique:users,email',
                'phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:users,phone',
                'password' => 'required|string|confirmed',
                'password_confirmation' => 'required',
            ]);
        $rand = User::randToken();
        $checkEmailSend = User::verifyMail(request()->username,request()->email,$rand);
        if ($checkEmailSend == false){
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        $create = User::create([
            'username' => request()->username,
            'email'    => request()->email,
            'phone'    => request()->phone,
            'email_verified' => $rand,
            'password' => Hash::make(request()->password),
        ]);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return redirect('dashboard')->with('success','تم إضافة المدير بنجاح');
    }

    public function edit ($id) {
        validator::make(['id'=>$id],
            [
                'id' => 'required|integer|exists:admins,id',
            ])->validate();
        $data = User::find($id);
        return view('dashboard.user.edit',compact('data'));
    }

    public function update () {
        $this->validate(request(),
            [
                'id' => 'required|integer|exists:users,id'
            ]);
        $user = User::find(request()->id);

    }

    public function suspend ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:users,id'],
            [])->validate();
        $user = User::where('id',$id)->first();
        $user->status = '0';
        if (!$user->save()){
            return back()->with('error', 'حدث شئ ما خطأ لم يتم تنفيذ العملية');
        }
        return back()->with('success','تم حظر المستخدم بنجاح');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:users,id'],
            [])->validate();
        $user = User::where('id',$id)->first();
        $user->status = '1';
        if (!$user->save()){
            return back()->with('error', 'not activated');
        }
        return back()->with('success','تم اعادة تفعيل المستخدم بنجاح');
    }

    public function delete ($id) {

        validator::make(['id'=>$id],
            [
                'id' => 'required|integer|exists:users,id',
            ])->validate();
        $user = User::find($id);
        if (!$user->delete()) {
            return back()->with('error', 'حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المستخدم بنجاح');

    }

}
