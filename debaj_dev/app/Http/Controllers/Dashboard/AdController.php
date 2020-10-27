<?php

namespace App\Http\Controllers\Dashboard;

use Validator;
use App\Models\AdSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function index()
    {
        $data = AdSlider::orderBy('id','desc')->get();
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
        $inputs['text_ar'] = request()->text_ar;
        $inputs['text_en'] = request()->text_en;
        $inputs['link'] = request()->link;

        $create = AdSlider::create($inputs);
        if (!$create) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:ads_slider,id',
        ]);
        $data = AdSlider::findOrFail($id);
        return view('dashboard.ad.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png|max:5120'
        ]);
        $ad = AdSlider::findOrFail($request->id);

        $inputs['text_ar'] = request()->text_ar;
        $inputs['text_en'] = request()->text_en;
        $inputs['link'] = request()->link;

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
            'id'  => 'required|integer|exists:ads_slider,id',
        ])->validate();
        $ad = AdSlider::findOrFail($id);
        $delete = $ad->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم حذف الاعلان بنجاح');

    }
}
