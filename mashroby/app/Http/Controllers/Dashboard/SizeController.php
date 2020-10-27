<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function index()
    {
        $data = Size::all();
        return view('dashboard.size.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.size.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
        ]);

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;

        $create = Size::create($inputs);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة الحجم بنجاح');
    }

    public function edit($id)
    {

        validator::make(['id' => $id],[
            'id'  => ['required','integer','exists:sizes,id'],
        ])->validate();
        $data = Size::findOrFail($id);
        return view('dashboard.size.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
        ]);
        $size = Size::findOrFail($request->id);

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;

        $update = $size->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete()
    {
        $this->validate(request(),[
            'id'  => ['required','integer','exists:sizes,id']
        ]);
        $size = Size::findOrFail(request()->id);
//        $ads = Ad::where('category_id',request()->id)->first();
//        if($ads != null)
//        {
//            return back()->with('error','لا يمكن حذف حجم به اعلانات او أقسام فرعية');
//        }
        $delete = $size->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }

        return back()->with('success','تم حذف الحجم بنجاح');

    }
}
