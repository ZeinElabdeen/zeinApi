<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index () {
        $data = User::all();
        return view('dashboard.user.index',compact('data'));
    }
    // display memberships waiting for accept
    public function preAdvertiser () {
        $data = User::where('type','2')->get();
        $user = 'طلبات العضويات';
        return view('dashboard.user.preAdvertiser',compact('data','user'));
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

    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:users,id',
        ])->validate();
        $user = User::findOrFail($id);
        $delete = $user->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المستخدم بنجاح');

    }
    public function edit ($id) {
       validator::make(['id'=>$id],
           [
               'id' => 'required|integer|exists:users,id',
           ])->validate();
       $data = User::find($id);
       //dd($data);
       return view('dashboard.user.edit',compact('data'));
   }

   public function update () {
     //dd(request()->all());
       $this->validate(request(),
           [
               'id' => 'required|integer|exists:users,id',
               'username' => 'required|string|min:3|max:255',
               'phone'    => 'required|regex:/[0-9]{9}/',
           ]);
       if(isset(request()->password))
       {
         $this->validate(request(),
             [
               'password' => 'required|string|confirmed|min:8',
               'password_confirmation' => 'required',
             ]);
       }
       $user = User::find(request()->id);
       if(isset(request()->password))
       {
         $user->password = Hash::make(request()->password);
       }
       $user->username = request()->username;
       $user->phone = request()->phone;

       $update = $user->update($user->toArray());
       if (!$update) {
         return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
       }
       return back()->with('success','تم تعديل بيانات المستخدم');
   }


}
