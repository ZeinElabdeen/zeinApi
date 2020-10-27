<?php

namespace App\Http\Controllers\Api\Driver;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FcmController extends Controller
{
    public function submitToken () {
        $this->validate(request(),
            [
                'token' => 'required|string',
            ]);

        $user = auth('driver')->user();

        $user->fcm_token = request()->token;
        $user->save();
        return response(['message' => trans('response.updated')]);
    }
}
