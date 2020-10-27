<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FcmController extends Controller
{
    public function resubmit () {
        $this->validate(request(),
            [
                'token' => 'required|string',
            ]);

        $user = auth('api')->user();

        $user->fcm_token = request()->token;
        $user->save();
        return response('success');
    }
}
