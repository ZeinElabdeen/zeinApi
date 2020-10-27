<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Http\Resources\VendorsCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\AdsCollection;
use App\Models\Item;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Ad;
use App\Models\CancelReason;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index () {
      //  $categories = Category::all();
        $vendors = Vendor::where('status','1')->where('verified','1')->get();

        // return response()->json(['data' => ['categories' => new CategoryResource($categories),
        //     'vendors'=> new VendorsCollection($vendors)]]);

        return response()->json(['data' => [
            'vendors'=> new VendorsCollection($vendors)]
          ]);
    }

    public function login()
    {
        $this->validate(request(),[
            'phone'    => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
            'password' => 'required|string|min:8|max:191',
        ]);

        $phone = request()->phone;
        $password = request()->password;

        $user = User::where('phone',request()->phone)->first();

        if (!$user) {
          $vendor = Vendor::where('phone',request()->phone)->first();
          if (!$vendor) {
              return response()->json(['message' => trans('user.login.unauthorized')], 401);
          }else{
            return $this->login_vendor($phone,$password);
          }
        }else {
           return  $this->login_user($phone,$password);
        }

    }


    public function login_vendor($phone,$password)
    {

        $user = Vendor::where('phone',$phone)->first();

        if ($user->verified != '1') {
            $response['message']   = trans('user.login.not_verified');
            $response['is_verified'] = 0;
            return  response()->json(['data' => $response],200);
        }
        if ($user->status != '1') {
            return  response()->json(['message' => trans('user.login.suspended')],444);
        }
        $credentials = array('phone' => $phone,'password' => $password);

        if (! $token = auth('vendor')->attempt($credentials)) {
            return  response()->json(['message' => trans('user.login.unauthorized')], 401);
        }

        $id = auth('vendor')->id();
        $data['id'] = $id;
        $data['role'] = 'vendor';
        $data['is_verified'] = 1;
        $data['token'] = 'Bearer '.$token;
        return response()->json(['data' => $data]);
    }

    public function login_user($phone,$password)
    {

        $user = User::where('phone',$phone)->first();
        if (!$user) {
            return  response()->json(['message' => trans('user.login.unauthorized')], 401);
        }
        if ($user->verified != '1') {
            $response['message']   = trans('user.login.not_verified');
            $response['is_verified'] = 0;
            return  response()->json(['data' => $response],200);
        }
        if ($user->status != '1') {

            return  response()->json(['message' => trans('user.login.suspended')],444);
        }
        $credentials = array('phone' => $phone,'password' => $password);

        if (! $token = auth('api')->attempt($credentials)) {
            return  response()->json(['message' => trans('user.login.unauthorized')], 401);
        }

        $id = auth('api')->id();
        $data['id'] = $id;
        $data['role'] = 'user';
        $data['is_verified'] = 1;
        $data['token'] = 'Bearer '.$token;
        return response()->json(['data' => $data]);
    }

    public function sendCode () {
        $this->validate(request(),['phone' => ['required','regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/'],]);

        $token = $this->randToken();
        $user = User::where('phone',request()->phone)->first();
        if(!$user)
        {
          $user = Vendor::where('phone',request()->phone)->first();
          if(!$user)
          {
              return response()->json(['message'=> trans('response.no_user') ],444);
          }else {
            $role ='vendor';
          }
        }else {
          $role ='user';
        }
        $user->reset_password_code = $token;
        $user->code_expiration = date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(5)));
        $user->save();
        return response()->json(['message'=> trans('user.reset_pwd.code_sent') ,'code'=> $token,'role' => $role],200);

    }

    public function check () {
        $this->validate(request(),['code' => ['required','integer']]);

        $user = User::where('reset_password_code',request()->code)->where('code_expiration','>=',Carbon::now())->first();
        if (!$user) {

          $user = Vendor::where('reset_password_code',request()->code)->where('code_expiration','>=',Carbon::now())->first();
          if (!$user) {
            return response()->json(['message'=> trans('user.reset_pwd.code_expire') ],444);
          }
          else {
            $role ='vendor';
          }

        }
        else
        {
            $role ='user';
        }
        return response()->json(['data' => $user,'role' => $role]);
    }

    public function resetPassword () {
        $this->validate(request(),
            [
                'phone'    => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
                'password' => 'required|alphaNum|confirmed|min:8|max:36',
            ]);
        $user = User::where('phone',request()->phone)->first();
        if (!$user) {
            $user = Vendor::where('phone',request()->phone)->first();
          if (!$user) {
            return response()->json(['message'=> trans('response.no_user') ],444);
          }
          else {
            $role ='vendor';
          }
        }
        else {
            $role ='user';
        }
        $user->password = Hash::make(request()->password);
        $user->save();
        return response()->json(['message'=> trans('user.reset_pwd.success') ,'role' => $role ],200);
    }

    public function ads() {

      $data = Ad::all();
      return response()->json(['data' => ['items'=>new AdsCollection($data)]]);
  }

    public function reasons() {

      $data = CancelReason::all();
         return response()->json(['data' =>$data ]);
     }

  protected function randToken () {
      $token = rand(10000,99999);
      return (User::where('reset_password_code',$token)->first())?$this->randToken():$token;
  }

}
