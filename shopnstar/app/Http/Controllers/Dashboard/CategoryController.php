<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\Cats;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Cats::get();
        return view('dashboard.category.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $this->validate(request(), [
            'title' => 'required|string',
            'description'    => 'required|string',
            'icon'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // upload image
        if (request()->hasFile('icon')) {
            $imageName = md5(time()). '.'.request()->file('icon')->getClientOriginalExtension();
            $imageMove = request()->file('icon')->move(public_path('uploads/category'),$imageName);
            if (!$imageMove) {
                return  response()->json(['message' => trans('response.failed_image')],444);
            }
        }

        $inputs =  array('title' => request()->title,
                          'description' => request()->description,
                          'icon' => $imageName,
                         );

        $create = Cats::create($inputs);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة القسم بنجاح');
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:cats,id',
        ]);
        $data = Cats::findOrFail($id);
        return view('dashboard.category.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'  => 'required|string',
            'description'    => 'required|string',
            'icon'    => 'image|mimes:jpg,jpeg,png|max:5120',
        ]);

          $inputs['title'] = $request->title;
          $inputs['description'] = $request->description;

        // upload image
        if (request()->hasFile('icon')) {
            $imageName = md5(time()). '.'.request()->file('icon')->getClientOriginalExtension();
            $imageMove = request()->file('icon')->move(public_path('uploads/category'),$imageName);
            if (!$imageMove) {
                return  response()->json(['message' => trans('response.failed_image')],444);
            }
            $inputs['icon'] = $imageName;
        }
        $category = Cats::findOrFail($request->id);

        $update = $category->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete($id)
    {
      $this->validate(request(),['id' => $id],[
          'id'  => 'required|integer|exists:cats,id',
      ]);
        $category = Cats::findOrFail(request()->id);
      //  $ads = Item::where('category_id',request()->id)->first();
        // if($ads != null)
        // {
        //     return back()->with('error','لا يمكن حذف قسم به اعلانات ');
        // }
        $delete = $category->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف القسم بنجاح');

    }
}
