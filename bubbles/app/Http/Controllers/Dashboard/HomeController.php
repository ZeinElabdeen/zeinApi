<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Driver;
use App\Models\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['normalUsers'] = User::all()->count();
        $data['waitingUsers'] = User::where('status','0')->get()->count();
        $data['drivers'] = Driver::all()->count();
        $data['watingdrivers'] = Driver::where('status','0')->get()->count();
        return view('dashboard.home',compact('data'));
    }

}
