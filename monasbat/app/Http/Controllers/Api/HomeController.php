<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdsCollection;
use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\UserResource;
use App\Models\Ad;
use App\Models\User;
use App\Models\Attach;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
        $categories = Category::all();
        $ads = Ad::all();
        $user_ads_on = User::where('is_ad','1')->get(['id'])->toArray();
        $user_adson_rand  = array();
        foreach ($user_ads_on as $row) {
         $attach = Attach::where('vendor_id',$row['id'])->where('file_type', 'LIKE', "%image%")->get(['image','file_type'])->toArray();
         if(!empty($attach))
         {
            $randIndex = array_rand($attach);
            $row += [ "image" => config('attach_storage').$attach[$randIndex]['image'] ];
            $row += [ "type" => $attach[$randIndex]['file_type'] ];
            $user_adson_rand[] = $row;
         }
        
        }

        return response()->json(['data' => ['categories' => new CategoriesCollection($categories),
           'ads' => new AdsCollection($ads),'user_ads_on' => $user_adson_rand]]);

    }
}
