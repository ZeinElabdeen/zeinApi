<?php

namespace App\Http\Controllers\Dashboard;

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
            return back()->with('error', 'not activated');
        }
        return back()->with('success','تم اعادة تفعيل المستخدم بنجاح');
    }
    
    public function delete($id)
    {
      Validator::make(['id' => $id],['id' => 'required|integer|exists:users,id'])->validate();
      $todelete = User::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف المستخدم');
    }

}
