<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $data = Users::where('type', '1')->get();
        $user ='مقدمين الخدمة';
      }else{
        $data = Users::where('type', '0')->get();
        $user = "العملاء";
      }
      return view('dashboard.users.index',compact('data','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        return view('dashboard.salecodes.create');
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
     public function edit ($id) {
        validator::make(['id'=>$id],
            [
                'id' => 'required|integer|exists:users,id',
            ])->validate();
        $data = Users::find($id);
        //dd($data);
        return view('dashboard.users.edit',compact('data'));
    }

    public function update () {
      //dd(request()->all());
        $this->validate(request(),
            [
                'id' => 'required|integer|exists:users,id',
                'username' => 'string',
                'full_name' => 'string',
                'email'    => 'email',
                'address' => 'string',
            ]);
        if(isset(request()->password))
        {
          $this->validate(request(),
              [
                'password' => 'required|string|confirmed',
                'password_confirmation' => 'required',
              ]);
        }
        $user = Users::find(request()->id);
        if(isset(request()->password))
        {
          $user->password = Hash::make(request()->password);
        }
        $user->username = request()->username;
        $user->full_name = request()->full_name;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->address = request()->address;
        $update = $user->update($user->toArray());
        if (!$update) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تعديل بيانات المستخدم');
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
      $todelete = Users::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف المستخدم بنجاح');
    }


    public function suspend($id)
    {
      Validator::make(['id' => $id],['id' => 'required|integer|exists:users,id'])->validate();
      $userdata = Users::find($id);

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
      return back()->with('success','تم تعديل فعالية المستخدم');

    }
}
