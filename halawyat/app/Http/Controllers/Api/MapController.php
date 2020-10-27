<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseController;
use App\Http\Resources\VendorsCollection;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class MapController extends ResponseController
{
    public function index(Request $request)
    {
        $request->validate([
            'lat'=> ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng'=> ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        $latitude = request()->lat;
        $longitude = request()->lng;
        $data = DB::table('vendors')->select( DB::raw( "*,
                 (3959 * ACOS(COS(RADIANS($latitude))
                       * COS(RADIANS(`lat`))
                       * COS(RADIANS($longitude) - RADIANS(`lng`))
                       + SIN(RADIANS($latitude))
                       * SIN(RADIANS(`lat`)))) AS distance" )
        )
            ->orderBy( 'distance', 'asc' )
            ->get();

        return response()->json(['data' => new VendorsCollection($data)]);
    }

}
