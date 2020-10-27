<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BrandCollection;
use App\Http\Resources\CitiesCollection;
use App\Http\Resources\CityAdsResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\StatesCollection;
use App\Http\Resources\SubcategoriesResource;
use App\Models\Item;
use App\Models\City;
use Validator;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function index () {
        $states = City::states();
        $cities = City::cities();

        return response()->json(['data' => [
            'states' =>new StatesCollection($states),
            'cities' =>new CitiesCollection($cities),
        ]]);
    }

}
