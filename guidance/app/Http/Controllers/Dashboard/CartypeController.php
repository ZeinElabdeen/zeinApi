<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CartypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CarType::orderBy('created_at','desc')->get();
        return view('dashboard.CarType.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        return view('dashboard.CarType.create');
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
          'title_en'  => 'required|string',
          'title_ar'  => 'required|string',
      ]);

      $inputs['title_en'] = request()->title_en;
      $inputs['title_ar'] = request()->title_ar;
      $create = CarType::create($inputs);
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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:cars_types,id'])->validate();
      $data = CarType::find($id);
      $title = 'انواع السيارات';
      return view('dashboard.CarType.edit',compact('data','title'));
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
          'title_en'  => 'required|string',
          'title_ar'  => 'required|string',
      ]);
      $inputs['title_en'] = request()->title_en;
      $inputs['title_ar'] = request()->title_ar;
      $update = CarType::find(request()->id)->update($inputs);
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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:cars_types,id'])->validate();
      $todelete = CarType::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف نوع السيارة بنجاح');
    }



}
