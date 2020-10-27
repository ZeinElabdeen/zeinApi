<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        // membership users
//        $data['vendors'] = User::where('type','3')->get()->count();
        // membership users waiting for accept membership
//        $data['vendorsWaitingForAccept'] = User::where('type','2')->get()->count();
        // normal user
//        $data['normalUser'] = User::where('type','1')->get()->count();
        // ads
//        $data['ads'] = Ad::get()->count();
        // categories
//        $data['categories'] = Category::get()->count();
        // subcategories
//        $data['subcategories'] = Category::where('parent_id','!=',null)->get()->count();
//        dd($data['subcategories']);
        return view('dashboard.index',compact('data'));
    }
}
