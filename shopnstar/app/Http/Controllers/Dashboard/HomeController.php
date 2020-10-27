<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {

        // vendors
        $data['vendors'] = Vendor::get()->count();

        // normal user
       $data['normalUsers'] = User::get()->count();

        // ads
        $data['ads'] = Ad::get()->count();

        // categories
         $data['categories'] = Category::get()->count();

        // Item
         $data['items'] = Item::get()->count();


        return view( 'dashboard.home',compact('data') );
    }
}
