<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\admin\locationModel;
use Illuminate\Http\Request;

class locationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $country = locationModel::allCountry();
        $locationId = locationModel::countryID();
        // $city = locationModel::cityOfCountry($locationId);
        $city = locationModel::allcities();
        return view('admin.locations.alllocation',[
            'country'=> $country,
            'cities' =>$city
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show add city
        $country = locationModel::allCountry();
        return view('admin.locations.addCity',[
            'country'=> $country,
        ]);
    }

    public function createCountry()
    {
        //show add country

        return view('admin.locations.addCountry');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // add city
        $request->validate([
            'city_name'=> 'required',
            'city_name_ar'=>'required',
            'location_id'=>'required|numeric'
        ]);

        $data = new locationModel;
        $data->city_name = $request->city_name;
        $data->city_name_ar =$request->city_name_ar;
        $data->location_id = $request->location_id;

        locationModel::addCity($data);

        return redirect('admin/location')->with('success','success added city');
    }

    public function storeCoutry(Request $request)
    {
        // add country
        $request->validate([
            'country'=> 'required',
            'country_ar'=>'required'
        ]);

        $data = new locationModel;
        $data->country = $request->country;
        $data->country_ar = $request->country_ar;

        locationModel::addCountry($data);

        return redirect('admin/location')->with('success','success added country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show country details
        $country = locationModel::showContry($id);
        return view('admin.locations.countryDetails',[
            'country' => $country
        ]);
    }
    public function showCity($id)
    {
        // show city details
        $city = locationModel::showCity($id);
        return view('admin.locations.cityDetails',[
            'cities' => $city
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update country
        $request->validate([
            'country'=> 'required',
            'country_ar'=>'required'
        ]);

        $data = new locationModel;
        $data->country = $request->country;
        $data->country_ar = $request->country_ar;

        locationModel::updateCountry($data,$id);
            // return $data;
        return redirect()->back()->with('success','success updated country');

    }


    public function updateCity(Request $request, $id)
    {
        //update city
        $request->validate([
            'city_name'=> 'required',
            'city_name_ar'=>'required'
        ]);

        $data = new locationModel;
        $data->city_name = $request->city_name;
        $data->city_name_ar =$request->city_name_ar;

        locationModel::updateCity($data,$id);
            // return $data;
        return redirect()->back()->with('success','success updated city');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete city
        locationModel::deleteCity($id);
        return back();
    }

    public function destroyCountry($id)
    {
        // delete country
        if(locationModel::deleteCountry($id)){
            locationModel::deleteCityOfCountry($id);
        }
        return back();
    }
}
