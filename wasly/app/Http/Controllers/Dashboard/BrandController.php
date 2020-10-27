<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Classification;
use App\Models\OrderItems;
use Validator;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index () {
        $data =  Brand::orderBy('id','desc')->get();
        return view('dashboard.brand.index',compact('data'));
    }

    public function create () {
        $categories = Category::orderBy('id','desc')->get();
        $cities = City::where('state_id','!=',null)->where('city_id',null)->where('village',null)->orderBy('id','desc')->get();
        return view('dashboard.brand.create',compact('categories','cities'));
    }

    public function store () {
        Validator::make(
            request()->all(),
            [
                'title'  => 'required|string|min:3',
                'category' => 'required|integer|exists:categories,id',
                'city' => 'required|integer|exists:cities,id',
                'image'      => 'required|image|mimes:jpg,jpeg,png|max:5120',

            ])->validate();
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/brand'),$imageName);
        if (!$imageMove) {
            return back()->with('error',trans('response.failed'));
        }

        $new = Brand::create([

            'title'       => request()->title,
            'image'       => $imageName,
            'category_id'   => request()->category,
            'city_id'   => request()->city,
        ]);
        if (!$new){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:brands,id'],
            [])->validate();
        $data = Brand::findOrFail($id);
        $categories = Category::orderBy('id','desc')->get();

        return view('dashboard.brand.edit',compact('data','categories'));
    }

    public function reports($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:brands,id'],
            [])->validate();
        $data = Brand::findOrFail($id);
        $orders_items =OrderItems::join('items','items.id' , '=','order_items.item_id')
                                ->where('brand_id',$id)
                                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                                ->get(['order_items.*','orders.code','items.title']);


        return view('dashboard.brand.reports',compact('data','orders_items'));
    }

    public function update () {

        Validator::make(
            request()->all(),
            [
                'id'    => 'required|integer|exists:brands,id',
                'title'  => 'nullable|string|min:3',
                'category' => 'nullable|integer|exists:categories,id',
                'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            ],
            [])->validate();
        $data = Brand::findOrFail(request()->id);

        if (request()->hasFile('image')){
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/brand'),$imageName);
            if (!$imageMove) {
                return response()->json(['message' => trans('response.failed')],444);
            }
            if ($data->image != null && file_exists(public_path('uploads/brand/'.$data->image))) {
                unlink(public_path('uploads/brand/'.$data->image));
            }
        }

        $data->title = (request()->title == null)? $data->title :request()->title;
        $data->category_id = (request()->category == null)? $data->category_id :request()->category;
        $data->image = (request()->image == null)? $data->image : $imageName;

        $update = $data->save();
        if (!$update){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }


    public function suspend ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:brands,id'],
            [])->validate();
        $brand = Brand::where('id',$id)->first();
        $brand->status = '0';
        if (!$brand->save()){
            return back()->with('error', 'not suspended');
        }
        return back()->with('success',' suspended successfully');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:brands,id'],
            [])->validate();
        $brand = Brand::where('id',$id)->first();
        $brand->status = '1';
        if (!$brand->save()){
            return back()->with('error', 'not activated');
        }
        return back()->with('success','activated successfully');
    }

    public function delete ($id)
    {
        Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|integer|exists:brands,id',
            ])->validate();
        $brand = Brand::find($id);
        if (!$brand->delete()) {
            return back()->with('error', trans('response.failed'));
        }
        if ($brand->image != null && file_exists(public_path('uploads/brand/'.$brand->image))) {
            unlink(public_path('uploads/brand/'.$brand->image));
        }
        return back()->with('success',trans('response.deleted'));
    }

    public function brandClassifications ($id) {
        Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|integer|exists:brands,id',
            ]
        )->validate();
        $data = Classification::where('brand_id',$id)->get();
        return response()->json(['status' => 1, 'data'=>$data]);
    }

}
