<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Classification;
use App\Models\Brand;
use Validator;
use App\Http\Controllers\Controller;

class ClassificationController extends Controller
{
    public function index () {
        $data =  Classification::orderBy('id','desc')->get();
        return view('dashboard.classification.index',compact('data'));
    }

    public function create () {
        $brands = Brand::orderBy('id','desc')->get();
        return view('dashboard.classification.create',compact('brands'));
    }

    public function store () {
        Validator::make(
            request()->all(),
            [
                'title'  => 'required|string|min:3',
                'brand' => 'required|integer|exists:brands,id',
                'image'      => 'required|image|mimes:jpg,jpeg,png|max:5120',

            ])->validate();
        $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
        $imageMove = request()->file('image')->move(public_path('uploads/classification'),$imageName);
        if (!$imageMove) {
            return back()->with('error',trans('response.failed'));
        }

        $new = Classification::create([

            'title'       => request()->title,
            'image'       => $imageName,
            'brand_id'   => request()->brand,
        ]);
        if (!$new){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:classifications,id'],
            [])->validate();
        $data = Classification::findOrFail($id);
        $brands = Brand::orderBy('id','desc')->get();
        return view('dashboard.classification.edit',compact('data','brands'));
    }

    public function update () {

        Validator::make(
            request()->all(),
            [
                'id'    => 'required|integer|exists:classifications,id',
                'title'  => 'nullable|string|min:3',
                'brand' => 'nullable|integer|exists:brands,id',
                'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            ],
            [])->validate();
        $data = Classification::findOrFail(request()->id);

        if (request()->hasFile('image')){
            $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
            $imageMove = request()->file('image')->move(public_path('uploads/classification'),$imageName);
            if (!$imageMove) {
                return response()->json(['message' => trans('response.failed')],444);
            }
            if ($data->image != null && file_exists(public_path('uploads/classification/'.$data->image))) {
                unlink(public_path('uploads/classification/'.$data->image));
            }
        }

        $data->title = (request()->title == null)? $data->title :request()->title;
        $data->brand_id = (request()->brand == null)? $data->brand_id :request()->brand;
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
            ['id' => 'required|integer|exists:classifications,id'],
            [])->validate();
        $classifications = Classification::where('id',$id)->first();
        $classifications->status = '0';
        if (!$classifications->save()){
            return back()->with('error', 'not suspended');
        }
        return back()->with('success',' suspended successfully');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:classifications,id'],
            [])->validate();
        $classifications = Classification::where('id',$id)->first();
        $classifications->status = '1';
        if (!$classifications->save()){
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
                'id' => 'required|integer|exists:classifications,id',
            ])->validate();
        $classification = Classification::findOrFail($id);
        if (!$classification->delete()) {
            return back()->with('error', trans('response.failed'));
        }
        if ($classification->image != null && file_exists(public_path('uploads/classification/'.$classification->image))) {
            unlink(public_path('uploads/classification/'.$classification->image));
        }
        return back()->with('success',trans('response.deleted'));
    }

}
