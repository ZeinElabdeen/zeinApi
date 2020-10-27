<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::get();
        return view('dashboard.category.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.category.create');
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

        $create = Category::create($inputs);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة القسم بنجاح');
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:categories,id',
        ]);
        $data = Category::findOrFail($id);
        return view('dashboard.category.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
        ]);
        $category = Category::findOrFail($request->id);

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;

        $update = $category->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete()
    {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:categories,id',
        ]);
        $category = Category::findOrFail(request()->id);
        $ads = Ad::where('category_id',request()->id)->first();
        if($ads != null)
        {
            return back()->with('error','لا يمكن حذف قسم به اعلانات او أقسام فرعية');
        }
        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
