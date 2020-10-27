<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CarCollection;
use App\Models\CarModel;
use App\Http\Controllers\Controller;
use App\Models\CarType;

class CarController extends Controller
{
    public function carsModelsAndTypes () {
        $models = CarModel::all();
        $types = CarType::all();
        return response()->json(['data' =>['models' => new CarCollection($models),
            'types' => new CarCollection($types)]]);
    }
}
