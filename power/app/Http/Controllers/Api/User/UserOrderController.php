<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\UserOrdersCollection;
use Validator;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    public function __construct()
    {
        parent::__construct('user');
    }

    public function peopleTransfers ($status = '0') {
        Validator::make(['status' => $status],['status' => 'required|integer|in:0,1,2,3,4,5'])->validate();
        $data = $this->user->peopleTransfers->where('status',$status);
        return response()->json(['data' => new UserOrdersCollection($data)]) ;
    }

    // public function packagesTransfers ($status = '0') {
    //     Validator::make(['status' => $status],['status' => 'required|integer|in:0,1,2,3'])->validate();
    //     $data = $this->user->packagesTransfers->where('status',$status);
    //     return response()->json(['data' => new UserOrdersCollection($data)]) ;
    // }
}
