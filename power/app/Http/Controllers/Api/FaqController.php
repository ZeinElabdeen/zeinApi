<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index () {
        $data = Faq::all();
        return response()->json(['data' => new FaqResource($data)]);
    }
}
