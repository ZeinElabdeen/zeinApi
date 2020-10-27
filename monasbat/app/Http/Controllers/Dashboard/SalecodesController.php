<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Salecodes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SalecodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Salecodes::orderBy('created_at','desc')->get();
        return view('dashboard.salecodes.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     private function randomId(){
     $id = str_random(10);
     $validator = \Validator::make(['id'=>$id],['id'=>'unique:salecodes,code']);
     if($validator->fails()){
          return $this->randomId();
     }
     return $id;
}

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


      $this->validate(request(),[
          'salevalue'  => 'required|integer',
          'numbers_code'  => 'required|integer',
      ]);

      $created_codes = array();
      $numbers_code = request()->numbers_code;
      for($i = 0;$i < $numbers_code;$i++)
      {
        $inputs['salevalue'] = request()->salevalue;
        $inputs['code'] = $this->randomId();
        $created_codes[$i] = $inputs['code'] ;
        $create = Salecodes::create($inputs);
      }
    //  print_r($created_codes);
      if (!$create) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      //return back()->with('success','تم إضافة العناصر بنجاح');
      return view('dashboard.salecodes.created_codes',compact('created_codes'));
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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:salecodes,id'])->validate();
      $data = Salecodes::find($id);
      $title = 'Salecodes';
      return view('dashboard.salecodes.edit',compact('data','title'));
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
          'salevalue'  => 'required|integer',
      ]);
      $inputs['salevalue'] = request()->salevalue;
      $update = Salecodes::find(request()->id)->update($inputs);
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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:salecodes,id'])->validate();
      $todelete = Salecodes::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف كود الخصم بنجاح');
    }


    // public function suspend($id)
    // {
    //   Validator::make(['id' => $id],['id' => 'required|integer|exists:salecodes,id'])->validate();
    //   $codedata = Salecodes::find($id);
    //
    //   if($codedata->statu == '1')
    //   {
    //         $codedata->statu = '0' ;
    //         $update = $codedata->update($codedata->toArray());
    //   }
    //   else {
    //     $codedata->statu = '1' ;
    //     $update = $codedata->update($codedata->toArray());
    //   }
    //
    //   if (!$update) {
    //       return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
    //   }
    //   return back()->with('success','تم تعديل كود الخصم');
    //
    // }
}
