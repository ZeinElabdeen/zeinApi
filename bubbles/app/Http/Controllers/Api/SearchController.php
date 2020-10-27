<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\allClubs;
use App\Models\Club;
use App\Models\ClubAttribute;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search () {
//        dd(request()->all());
        $this->validate(request(),['search' => 'required|string|min:3|max:255'],[],['search' => 'كلمة البحث']);

        $search = request()->search;

        /**search in clubs table */
        $data1 = Club::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('city', 'LIKE', '%' . $search . '%')->get();

        /**search in club_attributes table */
        $clubs = ClubAttribute::where('value', 'LIKE', '%' . $search . '%')
            ->orWhere('key', 'LIKE', '%' . $search . '%')->distinct()->get('club_id');


        /**loop through search in club_attributes result and extract id in collection*/
        $data2 =  collect();
        foreach ($clubs as $club) {
            $data2->push($club->club) ;
        }

        /**merge the 2 collections without repeating*/
        $data  = $data1->merge($data2);

        return response()->json(['data' => new allClubs($data)]) ;
    }
}
