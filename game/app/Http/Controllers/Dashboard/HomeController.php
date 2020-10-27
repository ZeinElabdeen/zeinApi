<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Club;
use App\Models\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['normalUsers'] = 5;
        $data['waitingUsers'] = 6;
        $data['membershipUsers'] = 7;
        $data['clubs'] = 3;
        return view('dashboard.home',compact('data'));
    }
}
