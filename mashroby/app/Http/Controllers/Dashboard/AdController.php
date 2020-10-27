<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ad;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function index () {
        $data = Ad::orderBy('id','desc')->get();
        return view('dashboard.ad.index',compact('data'));
    }

    public function create () {
        return view('dashboard.ad.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
            'image'     => 'required|image|mimes:jpg,jpeg,png|max:4000',
            'size'      => 'required|integer',
            'category'  => 'required|integer',
            'stock'     => 'required|integer|min:1',
            'price'     => 'required|integer|min:1',
            'type'      => 'required|integer|in:1,2',
            'discount'  => 'required_if:type,=,2|nullable|integer|min:1|max:100',
        ]);

        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/ad'),$imageName);
        if (!$imageMove) {
            return back()->with(['error' => 'حدث شئ ما خطأ لم يتم رفع الصورة']);
        }

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;
        $inputs['size_id']  = $request->size;
        $inputs['category_id'] = $request->category;
        $inputs['stock']    = $request->stock;
        $inputs['price']    = $request->price;
        $inputs['type']     = $request->type;
        $inputs['discount'] = $request->discount;
        $inputs['image'] = $imageName;
//        dd($inputs);

        $create = Ad::create($inputs);
        if (!$create) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم إضافة الاعلان بنجاح');
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
//        dd($request->all());
        $request->validate([
            'id'        => 'required|integer|exists:ads,id',
            'title_ar'  => 'required|string|regex:/[اأإء-ي]/ui',
            'title_en'  => 'required|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:4000',
            'size'      => 'required|integer',
            'category'  => 'required|integer',
            'stock'     => 'required|integer|min:1',
            'price'     => 'required|integer|min:1',
            'type'      => 'required|integer|in:1,2',
            'discount'  => 'required_if:type,=,2|nullable|integer|min:1|max:100',
        ]);
        $ad = Ad::findOrFail($request->id);
        if ($request->hasFile('image') && $request->image != null) {
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/ad'),$imageName);
            if (!$imageMove) {
                return back()->with(['error' => 'حدث شئ ما خطأ لم يتم رفع الصورة']);
            }
            $inputs['image'] = $imageName;
            if ($ad->image != null && file_exists(public_path('uploads/ad/'.$ad->image))) {
                unlink(public_path('uploads/ad/'.$ad->image));
            }
        }
        else {
            $inputs['image'] = $ad->image;
        }

        $inputs['title_ar'] = $request->title_ar;
        $inputs['title_en'] = $request->title_en;
        $inputs['size_id']  = $request->size;
        $inputs['category_id'] = $request->category;
        $inputs['stock']    = $request->stock;
        $inputs['price']    = $request->price;
        $inputs['type']     = $request->type;
        $inputs['discount'] = $request->discount;

        $update = $ad->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete()
    {
        $this->validate(request(),[
            'id'  => 'required|integer|exists:ads,id',
        ]);
        $ad = Ad::findOrFail(request()->id);
        $checkIfOrdered = OrderItems::where('item_id',request()->id)->first();
        if($checkIfOrdered != null)
        {
            return back()->with('error','لا يمكن حذف اعلان تم طلبه');
        }
        $delete = $ad->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        if ($ad->image != null && file_exists(public_path('uploads/ad/'.$ad->image))) {
            unlink(public_path('uploads/ad/'.$ad->image));
        }
        return back()->with('success','تم حذف الاعلان بنجاح');

    }

}
