<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_type = request()->segment(3);
      if($user_type == 'vendors')
      {
        $data = User::where('type', '!=', '0')->get();
        $user ='مقدمين الخدمة';
      }else{
        $data = User::where('type', '0')->get();
        $user = "العملاء";
      }
      return view('dashboard.users.index',compact('data','user','user_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_ad($id)
    {
      Validator::make(['id' => $id],['id' => 'required|integer|exists:users,id'])->validate();

      $userdata = User::find($id);
      if($userdata->is_ad == '1')
      {
            $userdata->is_ad = '0' ;
            $update = $userdata->update($userdata->toArray());
      }
      else {
        $userdata->is_ad = '1' ;
        $update = $userdata->update($userdata->toArray());
      }

      if (!$update) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم تعديل البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


    public function suspend($id)
    {
      Validator::make(['id' => $id],['id' => 'required|integer|exists:users,id'])->validate();
      $userdata = User::find($id);

      if($userdata->status == '1')
      {
            $userdata->status = '0' ;
            $update = $userdata->update($userdata->toArray());
      }
      else {
        $userdata->status = '1' ;
        $update = $userdata->update($userdata->toArray());
      }

      if (!$update) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم تعديل بنجاح');

    }
}
