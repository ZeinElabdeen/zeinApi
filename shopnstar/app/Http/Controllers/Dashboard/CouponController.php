<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use Validator;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{

  public function randomId(){
    $id = str_random(10);
    $validator = \Validator::make(['id'=>$id],['id'=>'unique:coupons,code']);
    if($validator->fails()){
         return $this->randomId();
    }
    return $id;
  }

    public function index () {
        $data =  Coupon::orderBy('id','desc')->get();
        return view('dashboard.coupon.index',compact('data'));
    }

    public function create () {
        return view('dashboard.coupon.create');
    }

    public function store () {
//        dd(request()->all());
        Validator::make(
            request()->all(),
            [
                'code' => 'required|string|min:6|unique:coupons,code',
                'discount' => 'required|integer|min:1,max:100',

            ])->validate();
        $new = Coupon::create(request()->all());
        if (!$new){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:coupons,id'],
            [])->validate();
        $data = Coupon::findOrFail($id);
//        dd($data);
        return view('dashboard.coupon.edit',compact('data'));
    }

    public function update () {
        Validator::make(
            request()->all(),
            [
                'id' => 'required|integer|exists:coupons,id',
              //  'code' => 'required|string|min:6|unique:coupons,code,'.request()->id,
                'discount' => 'required|integer|min:1,max:100',

            ])->validate();

        $new = Coupon::find(request()->id);
        $update = $new->update([
          //  'code' => request()->code,
            'discount' => request()->discount,
        ]);
        if (!$update){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }

    public function suspend ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:coupons,id'])->validate();
        $state = Coupon::where('id',$id)->first();
        $state->status = '0';
        if (!$state->save()){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',' تم الإيقاف ');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:coupons,id'])->validate();
        $state = Coupon::where('id',$id)->first();
        $state->status = '1';
        if (!$state->save()){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success','تم التفعيل بنجاح');
    }

    public function delete ($id)
    {
        Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|integer|exists:coupons,id',
            ])->validate();
        $state = Coupon::find($id);
        if (!$state->delete()) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.deleted'));
    }
}
