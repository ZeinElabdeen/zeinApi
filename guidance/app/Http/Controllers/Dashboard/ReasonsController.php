<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\CancelReason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $data = CancelReason::where('type',$type)->orderBy('created_at','desc')->get();
        return view('dashboard.cancel_reasons.index',compact('data','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create($type)
    {
        return view('dashboard.cancel_reasons.create',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $this->validate(request(),[
          'reason_ar'  => 'required|string',
          'reason_en'  => 'required|string',
          'type'  => 'required|integer',
      ]);

      $inputs['reason_ar'] = request()->reason_ar;
      $inputs['reason_en'] = request()->reason_en;
      $inputs['type'] = request()->type;
      $create = CancelReason::create($inputs);
      if (!$create) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم إضافة العناصر بنجاح');
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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:cancel_reasons,id'])->validate();
      $data = CancelReason::find($id);
      $title = 'اسباب الرفض';
      return view('dashboard.cancel_reasons.edit',compact('data','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
      $this->validate(request(),[
        'reason_ar'  => 'required|string',
        'reason_en'  => 'required|string',
      ]);

      $inputs['reason_ar'] = request()->reason_ar;
      $inputs['reason_en'] = request()->reason_en;

      $update = CancelReason::find(request()->id)->update($inputs);

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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:cancel_reasons,id'])->validate();
      $todelete = CancelReason::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف السبب بنجاح');
    }



}
