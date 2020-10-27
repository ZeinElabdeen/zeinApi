<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Attach;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemDetails;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index () {
        $data = Item::orderBy('id','desc')->get();
        return view('dashboard.item.index',compact('data'));
    }

    public function create () {
        $brands = Brand::all();
        return view('dashboard.item.create',compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'description'  => 'required|string|max:255',
            'brand'  => 'required|integer|exists:brands,id',
            'classification'  => 'required|integer|exists:classifications,id',
            'price'     => 'required|integer|min:1',
            'images'     => 'required|array',
            'images.*' => 'required|image|mimes:png,jpg,jpeg|max:5120',
        ]);


        $inputs['title'] = $request->title;
        $inputs['description'] = $request->description;
        $inputs['brand_id']  = $request->brand;
        $inputs['classification_id'] = $request->classification;
//        $inputs['stock']    = $request->stock;
        $inputs['price']    = $request->price;
        $inputs['type']     = $request->type;

        $create = Item::create($inputs);
        if (!$create) {
            return back()->with('error',trans('response.failed'));
        }
        if (request()->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $index => $image) {
                $imageName = md5(time().$index). '.'.$image->getClientOriginalExtension();
                $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
                if (!$imageMove) {
                    return back()->with('error',trans('response.failed'));
                }
                Attach::create([
                    'item_id' => $create->id,
                    'image' => $imageName,
                ]);
            }
        }
        // store item details
        if (request()->has('details') && request()->details != null) {
            foreach (request()->details as $detail) {
              if(!empty($detail["key"]) && !empty($detail["value"])):
                ItemDetails::create([
                    'item_id' => $create->id,
                    'key' => $detail["key"],
                    'value' => $detail["value"]
                ]);
              endif;
            }
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:items,id',
        ]);
        $data = Item::findOrFail($id);
        $brands = Brand::all();
        return view('dashboard.item.edit', compact('data','brands'));
    }

    public function update(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'id'        => 'required|integer|exists:items,id',
            'title'  => 'required|string|max:255',
            'description'  => 'required|string|max:255',
            'brand'  => 'required|integer|exists:brands,id',
            'classification'  => 'required|integer|exists:classifications,id',
            'price'     => 'required|integer|min:1',
            'images'     => 'nullable|array',
            'images.*' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
        ]);
        $item = Item::findOrFail($request->id);
        if ($request->hasFile('images')) {
            $images = request()->file('images');
            foreach ($images as $index => $image) {
                $imageName = md5(time().$index). '.'.$image->getClientOriginalExtension();
                $imageMove = $image->move(public_path('uploads/attaches'),$imageName);
                if (!$imageMove) {
                    return back()->with('error',trans('response.failed'));
                }
                Attach::create([
                    'item_id' => $item->id,
                    'image' => $imageName,
                ]);
            }
        }

// store item details
        if (request()->has('details') && request()->details != null) {
            foreach (request()->details as $detail) {
              if(!empty($detail["key"]) && !empty($detail["value"])):
                ItemDetails::create([
                    'item_id' => $item->id,
                    'key' => $detail["key"],
                    'value' => $detail["value"]
                ]);
              endif;  
            }
        }
        $inputs['title'] = $request->title;
        $inputs['description'] = $request->description;
        $inputs['brand_id']  = $request->brand;
        $inputs['classification_id'] = $request->classification;
//        $inputs['stock']    = $request->stock;
        $inputs['price']    = $request->price;
        $inputs['type']     = $request->type;

        $update = $item->update($inputs);
        if (!$update) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        return back()->with('success','تم تحديث البيانات بنجاح');
    }


    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:items,id',
        ])->validate();
        $item = Item::findOrFail($id);

//        $ads = Ad::where('category_id',request()->id)->first();
//        if($ads != null)
//        {
//            return back()->with('error','لا يمكن حذف منتج تم طلبه');
//        }
        $delete = $item->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        if ($item->image != null && file_exists(public_path('uploads/item/'.$item->image))) {
            unlink(public_path('uploads/item/'.$item->image));
        }
        return back()->with('success','تم حذف المنتج بنجاح');

    }

}
