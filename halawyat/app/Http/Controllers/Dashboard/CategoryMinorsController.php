<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryMinorsController extends Controller
{
    public function index()
    {
        $data = Category::where('parent_id','!=',NULL)->get();
        return view('dashboard.minors.index',compact('data'));
    }

    public function create()
    {
        $majors = Category::where('parent_id',NULL)->get();
        return view('dashboard.minors.create',compact('data','majors'));
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
            'parent_id'  => 'required|integer',
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);
        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;
        $inputs['parent_id'] = $request->parent_id;

        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/category'),$imageName);
        if (!$imageMove) {
            return back()->with('error',trans('response.failed'));
        }

        $inputs['icon'] = $imageName;

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
        $majors = Category::where('parent_id',NULL)->get();
        return view('dashboard.minors.edit', compact('data','majors'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
            'parent_id'  => 'required|integer',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);
        $category = Category::findOrFail($request->id);

        if ($request->hasFile('image')){
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/category'),$imageName);
            if (!$imageMove) {
                return response()->json(['message' => trans('response.failed')],444);
            }
            if ($category->image != null && file_exists(public_path('uploads/category/'.$category->image))) {
                unlink(public_path('uploads/category/'.$category->image));
            }
            $inputs['icon'] = $imageName;
        }

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;
        $inputs['parent_id'] = $request->parent_id;

        $update = $category->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:categories,id',
        ]);
        $category = Category::findOrFail(request()->id);

        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
