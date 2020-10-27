<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class taskController extends Controller
{
    public function index()
    {
        $city = file_get_contents(public_path('city.json'));
        $cityAfter = json_decode($city);
        // return $cityAfter;
        return view('task',[
            'cities'=>$cityAfter,
        ]);
    }
    public function create(Request $request)
    {
        $city = file_get_contents(public_path('city.json'));
        $cityAfter = json_decode($city);
        $person = file_get_contents(public_path('person.json'));
        $personAfter = json_decode($person);

        $afterFilter = array();
        foreach ($personAfter as $key => $value) {
            if($value->city == $request->cities && $value->job == $request->job){
               
                array_push($afterFilter,$value);

            }
        }

        // return $request->all();
        
        return view('task',[
            'persons'=>$afterFilter,
            'cities'=>$cityAfter,
        ]);
    }

    public function createApi(Request $request)
    {

        $city = file_get_contents(public_path('city.json'));
        $cityAfter = json_decode($city);
        $person = file_get_contents(public_path('person.json'));
        $personAfter = json_decode($person);

        $afterFilter = array();
        foreach ($personAfter as $key => $value) {
            if($value->city == $request->city && $value->job == $request->job){
               
                array_push($afterFilter,$value);

            }
        }

        
        return response()->json([$afterFilter]);

    }
}
