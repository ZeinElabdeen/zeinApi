<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{

    protected function apiResponse($response,$code)
    {
        return response()->json($response, $code);
    }
}
