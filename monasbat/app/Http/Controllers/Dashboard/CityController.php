<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use App\Models\Ad;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        $data = City::get();
        return view('dashboard.city.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.city.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string|regex:/^[a-zA-Z ]/',
        ]);
        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;

        $create = City::create($inputs);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة القسم بنجاح');
    }

    public function edit($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:cities,id',
        ])->validate();
        $data = City::findOrFail($id);
        return view('dashboard.city.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string|regex:/^[a-zA-Z ]/',
        ]);
        $city = City::findOrFail($request->id);

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;

        $update = $city->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:cities,id',
        ])->validate();
        $city = City::findOrFail($id);

        if(count($city->users) > 0)
        {
            return back()->with('error','لا يمكن حذف قسم به اعلانات او أقسام فرعية');
        }
        $delete = $city->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
