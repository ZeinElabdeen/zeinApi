<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use Validator;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index () {
        $data =  City::where('state_id','!=',null)->where('city_id','=',null)->orderBy('id','desc')->get();
        return view('dashboard.city.index',compact('data'));
    }

    public function create () {
        $states = City::where('state_id','=',null)->orderBy('id','desc')->get();
        return view('dashboard.city.create',compact('states'));
    }

    public function store () {
        Validator::make(
            [
                'city'  => request()->city,
                'state' => request()->state,
            ],
            [
                'city'  => 'required|string|min:3',
                'state' => 'required|integer|exists:cities,id',

            ])->validate();
        $stateName = City::where('id',request()->state)->first('state');
        $new = City::create([

            'city'       => request()->city,
            'state'      => $stateName->state,
            'state_id'   => request()->state,
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
        $data = City::findOrFail($id);
        return view('dashboard.city.edit',compact('data'));
    }

    public function update () {

        Validator::make(
            [
                'id'    => request()->id,
                'city'  => request()->city,
            ],
            [
                'id'    => 'required|integer|exists:cities,id',
                'city'  => 'required|string|min:3',
            ],
            [])->validate();
        $data = City::findOrFail(request()->id);
        $update = $data->update([
            'city'     => request()->city,
        ]);
        if (!$update){
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }


    public function suspend ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:cities,id'],
            [])->validate();
        $city = City::where('id',$id)->first();
        $city->status = '0';
        if (!$city->save()){
            return back()->with('error', 'not suspended');
        }
        return back()->with('success',' suspended successfully');
    }

    public function activate ($id) {
        Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:cities,id'],
            [])->validate();
        $city = City::where('id',$id)->first();
        $city->status = '1';
        if (!$city->save()){
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
                'id' => 'required|integer|exists:cities,id',
            ])->validate();
        $city = City::find($id);
        if (!$city->delete()) {
            return back()->with('error', trans('response.failed'));
        }
        return back()->with('success',trans('response.deleted'));
    }

    public function stateCities ($id) {
        Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|integer|exists:cities,id,status,1',
            ]
        )->validate();
        $data = City::where('state_id',$id)->where('city_id',null)->get();
        return response()->json(['status' => 1, 'data'=>$data]);
    }
}
