<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        // users
        $data['users'] = User::get()->count();
        // membership users waiting for accept membership
        $data['brands'] = Brand::get()->count();
        // normal user
        $data['items'] = Item::get()->count();
        // ads
        $data['new_orders'] = Order::where('status','0')->get()->count();
        // categories
        $data['categories'] = Category::get()->count();

        return view('dashboard.home',compact('data'));
    }
}
