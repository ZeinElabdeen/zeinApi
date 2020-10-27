<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index () {
        $data = User::all();
        return view('dashboard.user.index',compact('data'));
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
            return back()->with('error', 'حدث شئ ما خطأ لم يتم تنفيذ العملية');
        }
        return back()->with('success','تم اعادة تفعيل المستخدم بنجاح');
    }

    public function delete ($id) {

      Validator::make(['id' => $id],['id' => 'required|integer|exists:users,id'])->validate();
        $admin = User::find($id)->delete();

        if (!$admin) {
            return back()->with('error', 'حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف المستخدم');
    }

    public function edit ($id) {
        validator::make(['id'=>$id],
            [
                'id' => 'required|integer|exists:users,id',
            ])->validate();
        $data = User::find($id);
        return view('dashboard.user.edit',compact('data'));
    }

    public function update () {
      //dd(request()->all());
        $this->validate(request(),
            [
                'id' => 'required|integer|exists:users,id',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone'    => 'required|numeric',
            ]);
        if(isset(request()->password))
        {
          $this->validate(request(),
              [
                'password' => 'required|string|confirmed',
                'password_confirmation' => 'required',
              ]);
        }
        $user = User::find(request()->id);
        if(isset(request()->password))
        {
          $user->password = Hash::make(request()->password);
        }
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->phone = request()->phone;

        $update = $user->update($user->toArray());
        if (!$update) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل بيانات المستخدم');
    }

}
