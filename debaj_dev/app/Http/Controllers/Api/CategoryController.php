<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryCollection;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\VendorDetails;
use Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $pagination;

    public function index($id) {
//        return request()->all();
        Validator::make(['sort_type' => request()->sort_type,'id'=>$id],
            [
                'id'=>['required','integer','exists:categories,id'],
                'sort_type' => 'required|in:0,1,2,3'
        ])->validate();

        switch (request()->sort_type){
            case 0:
                $data = User::where('category_id',$id)->paginate(12);
                break;
            case 1:
                $data = DB::table('users')
                    ->leftJoin('vendor_details','users.id','=','vendor_details.vendor_id')
                    ->where('category_id',$id)
                    ->orderBy('vendor_details.rate','desc')->paginate(12);
                break;
            case 2:
                $data = DB::table('users')
                    ->leftJoin('vendor_details','users.id','=','vendor_details.vendor_id')
                    ->where('category_id',$id)
                    ->orderBy('vendor_details.rate','asc')->paginate(12);
                break;
            case 3:
                $this->validate(request(),
                    [
                        'lat' => 'required|',
                        'lng' => 'required|'
                    ]
                );
                $latitude = request()->lat;
                $longitude = request()->lng;
                $data = DB::table('users')->select( DB::raw( "*,
                 (3959 * ACOS(COS(RADIANS($latitude))
                       * COS(RADIANS(`lat`))
                       * COS(RADIANS($longitude) - RADIANS(`lng`))
                       + SIN(RADIANS($latitude))
                       * SIN(RADIANS(`lat`)))) AS distance" )

                )->where('category_id',$id)
                    ->orderBy( 'distance', 'asc' )
                    ->paginate(12);
                break;
        }

//        return $data;

        $this->setPagination ($data);
        return response()->json(['data' => new CategoryCollection($data),'pagination' => $this->pagination]);
    }


    private function setPagination ($data) {
        $this->pagination = [
            'total' => $data->total(),
            'count' => $data->count(),
            'per_page' => $data->perPage(),
            'current_page' => $data->currentPage(),
            'total_pages' => $data->lastPage()
        ];
    }
}
