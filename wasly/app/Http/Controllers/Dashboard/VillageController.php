<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use Validator;
use App\Http\Controllers\Controller;

class VillageController extends Controller
{
    public function index () {
        $data =  City::where('state_id','!=',null)->where('city_id','!=',null)->orderBy('id','desc')->get();
        return view('dashboard.village.index',compact('data'));
    }

    public function create () {
        $states = City::where('state_id','=',null)->orderBy('id','desc')->get();
        return view('dashboard.village.create',compact('states'));
    }

    public function store () {
        Validator::make(
            [
                'village'  => request()->village,
                'state' => request()->state,
                'city' => request()->city,
                'shipping_cost' => request()->shipping_cost,
            ],
            [
                'village'  => 'required|string|min:3',
                'state' => 'required|integer|exists:cities,id',
                'city' => 'required|integer|exists:cities,id',
                'shipping_cost' => 'required|integer',

            ])->validate();
        $stateName = City::where('id',request()->state)->first('state');
        $cityName = City::where('id',request()->city)->first('city');
        $new = City::create([
            'village'       => request()->village,
            'shipping_cost'   => request()->shipping_cost,
            'state'      => $stateName->state,
            'city'      => $cityName->city,
            'state_id'   => request()->state,
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
            ['id' => 'required|integer|exists:cities,id'],
            [])->validate();
        $data = City::findOrFail($id);
        return view('dashboard.village.edit',compact('data'));
    }

    public function update () {

        Validator::make(
            [
                'id'    => request()->id,
                'village'  => request()->village,
                'shipping_cost'  => request()->shipping_cost,
            ],
            [
                'id'    => 'required|integer|exists:cities,id',
                'shipping_cost'    => 'required|integer',
                'village'  => 'required|string|min:3',
            ],
            [])->validate();
        $data = City::findOrFail(request()->id);
        $update = $data->update([
            'village'     => request()->village,
            'shipping_cost'     => request()->shipping_cost,
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

    public function getCity ($id) {
        Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => 'required|integer|exists:cities,id,status,1',
            ]
        )->validate();
        $data = City::where('state_id',$id)->get();
        return response()->json(['status' => 1, 'data'=>$data]);
    }
}
