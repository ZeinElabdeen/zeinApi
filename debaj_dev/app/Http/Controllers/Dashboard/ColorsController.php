<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\ResponseController;
use Validator;
use App\Models\Colors;
use Illuminate\Http\Request;

class ColorsController extends ResponseController
{
    public function index()
    {
        $data = Colors::orderBy('id','desc')->get();
        return view('dashboard.colors.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.colors.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'name_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'code'  => 'required',
        ]);

        $inputs['name_ar'] = $request->name_ar;
        $inputs['name_en'] = $request->name_en;
        $inputs['code'] = $request->code;


        $create = Colors::create($inputs);
        if (!$create) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:colors,id',
        ]);
        $data = Colors::findOrFail($id);
        return view('dashboard.colors.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
          'name_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
          'name_en'  => 'required|string|regex:/^[a-zA-Z ]/',
          'code'  => 'required',
        ]);
        $color = Colors::findOrFail($request->id);
        $inputs['name_ar'] = $request->name_ar;
        $inputs['name_en'] = $request->name_en;
        $inputs['code'] = $request->code;
        $update = $color->update($inputs);
        if (!$update) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }

    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:colors,id',
        ])->validate();
        $color = Colors::findOrFail($id);
        $delete = $color->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
