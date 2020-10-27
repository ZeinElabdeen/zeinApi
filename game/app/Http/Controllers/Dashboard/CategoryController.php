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
            'title'  => 'required|string|regex:/[اأإء-ي]/ui',
        ]);
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
            'title'  => 'required|string|regex:/[اأإء-ي]/ui',

        ]);
        $category = Category::findOrFail($request->id);

        $inputs['title'] = $request->title;

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

        if(count($category->questions) > 0)
        {
            return back()->with('error','لا يمكن حذف قسم به أسألة');
        }
        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
