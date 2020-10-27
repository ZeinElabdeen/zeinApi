<?php

namespace App\Http\Controllers\Api\User;


use Illuminate\Validation\Rule;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // validate city

        Validator::make(['city' => $request->city],
            [
                'city' => ['required','integer',Rule::exists('cities','id')->where(function ($query) {
                    $query->where('state_id','!=','NULL');
                })]
            ])->validate();

        // input validation
        $this->validate(request(), [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'city' => 'exists:cities,id,city_id,NULL',
            'phone' => 'required|regex:/[0-9]{9}/|unique:users,phone|size:11|starts_with:01',
            'password' => 'required|alphaNum|confirmed|min:8|max:36',
        ]);

        //$rand = User::randToken();
        // prepare inputs
        $data = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city,
            'is_verified' => 1,
            'password' => Hash::make($request->get('password')),
        ]);

        if (!$data->save()) {
            return response()->json(['message' => trans('response.failed')],444);
        }
        $user = User::where('id',$data->id)->first();
        $token = auth('api')->login($user,true);
        $id = auth('api')->id();
        $response['id'] = $id;
        $response['is_verified'] = '1';
        $response['token'] = 'Bearer '.$token;
        return response()->json(['data' => $response],200);

      //  return response()->json(['message' => trans('user.register.success')]);

    }
}
