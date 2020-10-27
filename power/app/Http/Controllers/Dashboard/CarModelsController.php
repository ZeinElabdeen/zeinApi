<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CarModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CarModel::orderBy('created_at','desc')->get();
        return view('dashboard.CarModel.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        return view('dashboard.CarModel.create');
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
      $create = CarModel::create($inputs);
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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:cars_models,id'])->validate();
      $data = CarModel::find($id);
      $title = 'موديلات السيارات';
      return view('dashboard.CarModel.edit',compact('data','title'));
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
        'title_ar'  => 'required|string',
        'title_en'  => 'required|string',
      ]);

      $inputs['title_en'] = request()->title_en;
      $inputs['title_ar'] = request()->title_ar;

      $update = CarModel::find(request()->id)->update($inputs);

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
      Validator::make(['id' => $id],['id' => 'required|integer|exists:cars_models,id'])->validate();
      $todelete = CarModel::find($id);
      $delete = $todelete->delete();
      if (!$delete) {
          return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
      }
      return back()->with('success','تم حذف موديل السيارة بنجاح');
    }



}
