<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
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
            'title'  => 'required|string',
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/category'),$imageName);
        if (!$imageMove) {
            return back()->with('error',trans('response.failed'));
        }

        $inputs['image'] = $imageName;
        $inputs['title'] = $request->title;

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
            'id'  => 'required|integer|exists:categories,id',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'title'  => 'nullable|string',
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
            $inputs['image'] = $imageName;
        }

        $inputs['title'] = $request->title;

        $update = $category->update($inputs);
        if (!$update) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }


    public function delete($id)
    {
        Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|integer|exists:categories,id',
            ])->validate();
        $category = Category::findOrFail(request()->id);
//        $ads = Item::where('category_id',request()->id)->first();
//        if($ads != null)
//        {
//            return back()->with('error','لا يمكن حذف قسم به اعلانات ');
//        }
        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error',trans('response.failed'));
        }
        if ($category->image != null && file_exists(public_path('uploads/category/'.$category->image))) {
            unlink(public_path('uploads/category/'.$category->image));
        }
        return back()->with('success',trans('response.deleted'));

    }
}
