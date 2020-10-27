<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use Validator;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function index () {
        $data =  City::where('state_id','=',null)->orderBy('id','desc')->get();
        return view('dashboard.state.index',compact('data'));
    }

    public function show ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:cities,id'],
            [])->validate();
        $data = City::where('state_id','=',$id)->get();
        $stateName = City::where('id','=',$id)->first('state');
        return view('dashboard.state.show',compact('data','stateName'));
    }

    public function create () {
        return view('dashboard.state.create');
    }

    public function store () {
        Validator::make(
            [
                'state' => request()->state,
            ],
            [
                'state' => 'required|string|min:3',

            ])->validate();
        $new = City::create([

            'state'     => request()->state,
        ]);
        if (!$new){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.added'));
    }

    public function edit ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:cities,id'],
            [])->validate();
        $data = City::where('id',$id)->first();
//        dd($data);
        return view('dashboard.state.edit',compact('data'));
    }

    public function update () {

        Validator::make(
            [
                'id' => request()->id,
                'state' => request()->state,
            ],
            [
                'id' => 'required|integer|exists:cities,id',
                'state' => 'required|string|min:3',
            ])->validate();

        $new = City::find(request()->id);
        $update = $new->update([

            'state'      => request()->state,
        ]);
        if (!$update){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }

    public function suspend ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:cities,id'])->validate();
        $state = City::where('id',$id)->first();
        $state->status = '0';
        if (!$state->save()){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',' تم الإيقاف ');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:cities,id'])->validate();
        $state = City::where('id',$id)->first();
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
                'id' => 'required|integer|exists:cities,id',
            ])->validate();
        $state = City::find($id);
        if (!$state->delete()) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.deleted'));
    }
}
