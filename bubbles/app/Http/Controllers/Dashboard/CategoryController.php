<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\ResponseController;
use Validator;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ResponseController
{
    public function index()
    {
        $data = Category::orderBy('id','desc')->get();
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
            'title_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/category'),$imageName);
        if (!$imageMove) {
            return back()->with('error',trans('response.failed_image'));
        }
        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;
        $inputs['image'] = $imageName;

        $create = Category::create($inputs);
        if (!$create) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
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
            'title_en'  => 'required|string|regex:/^[a-zA-Z ]/',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);
        $category = Category::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/category'),$imageName);
            if (!$imageMove) {
                return $this->apiResponse(['message' => trans('response.failed_image')],444);
            }
            if ($category->image != null && file_exists(public_path('uploads/category/'.$category->image))) {
                unlink(public_path('uploads/category/'.$category->image));
            }
            $inputs['image'] = $imageName;
        }

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;

        $update = $category->update($inputs);
        if (!$update) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }

    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:categories,id',
        ])->validate();
        $category = Category::findOrFail($id);

        if(count($category->users) > 0)
        {
            return back()->with('error','لا يمكن حذف قسم به مستخدمين');
        }
        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
