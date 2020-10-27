<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;

class AcceptMembershipController extends Controller
{
    public function index ($id) {
        Validator::make(['id' => $id],['required|integer|exists:users,id,type,2']);
        $user = User::find($id);
        $user->type = '3';
        $user->save();
        return back()->with('success','تم قبول العضوية بنجاح');
    }
}
