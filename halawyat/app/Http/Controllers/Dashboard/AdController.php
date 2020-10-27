<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function index()
    {
        $data = Ad::orderBy('id','desc')->get();
        return view('dashboard.ad.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.ad.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/ad'),$imageName);
        if (!$imageMove) {
            return back()->with('error',trans('response.failed_image'));
        }
        $inputs['image'] = $imageName;

        $create = Ad::create($inputs);
        if (!$create) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:ads,id',
        ]);
        $data = Ad::findOrFail($id);
        return view('dashboard.ad.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);
        $ad = Ad::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/ad'),$imageName);
            if (!$imageMove) {
                return back()->with('error' , trans('response.failed_image'));
            }
            if ($ad->image != null && file_exists(public_path('uploads/ad/'.$ad->image))) {
                unlink(public_path('uploads/ad/'.$ad->image));
            }
            $inputs['image'] = $imageName;
        }

        $update = $ad->update($inputs);
        if (!$update) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }

    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:ads,id',
        ])->validate();
        $ad = Ad::findOrFail($id);
        $delete = $ad->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف الاعلان بنجاح');

    }
}
