<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Users;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
      $data['normalUsers'] = Users::where('type', '0')->where('status', '1')->get()->count();
      $data['waitingUsers'] = Users::where('type', '0')->where('status', '0')->get()->count();
      $data['vendorUsers'] = Users::where('type', '1')->where('status', '1')->get()->count();
      $data['waitingvendorUsers'] = Users::where('type', '1')->where('status', '0')->get()->count();

        return view('dashboard.home',compact('data'));
    }
}
