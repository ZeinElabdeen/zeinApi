<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Driver;
use Validator;
use App\Http\Controllers\Controller;

class VendorsController extends Controller
{
    public function index () {
        $data = Driver::all();
        return view('dashboard.vendors.index',compact('data'));
    }

    public function suspend ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:drivers,id'],
            [])->validate();
        $user = Driver::where('id',$id)->first();
        $user->status = '0';
        if (!$user->save()){
            return back()->with('error', 'حدث شئ ما خطأ لم يتم تنفيذ العملية');
        }
        return back()->with('success','تم حظر المستخدم بنجاح');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:drivers,id'],
            [])->validate();
        $user = Driver::where('id',$id)->first();
        $user->status = '1';
        if (!$user->save()){
            return back()->with('error', 'not activated');
        }
        return back()->with('success','تم اعادة تفعيل المستخدم بنجاح');
    }

    public function show ($id) {

        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:drivers,id'],
            [])->validate();
        $data = Driver::where('id',$id)->first();
        $genders[0]= 'ذكر';
        $genders[1]= 'أنثي';
       return view('dashboard.vendors.show',compact('data','genders'));

    }

    public function delete($id)
    {
      Validator::make(['id' => $id],['id' => 'required|integer|exists:drivers,id'])->validate();
      $todelete = Driver::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف المستخدم');
    }

}
