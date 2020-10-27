<?php

namespace App\Http\Controllers\Api\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function sendCode () {
        $this->validate(request(),['email' => 'required|email|exists:users,email|max:191',]);

        $token = $this->randToken();
        $user = User::where('email',request()->email)->first();
        $user->reset_password_code = $token;
        $user->code_expiration = date('Y-m-d H:i:s', strtotime(Carbon::now()->addMinutes(5)));
        $user->save();
        $sendMail = $this->resetPasswordMail(request()->email,$token);
        if (!$sendMail){
            return response()->json(['message'=> 'can\'t send email' ],444);
        }

        return response()->json(['message'=> 'email sent' ]);


    }

    public function check () {
        $this->validate(request(),['code' => ['required','integer']]);

        $user = User::where('reset_password_code',request()->code)->where('code_expiration','>=',Carbon::now())->first();
        if (!$user) {
            return response()->json(['message'=> 'no such code or your code is expired' ],444);
        }
        return response()->json(['data' => $user]);
    }

    public function resetPassword () {
        $this->validate(request(),
            [
                'email'    => 'required|email|exists:users,email|max:191',
                'password' => 'required|alphaNum|confirmed|min:8|max:36',
            ]);
        $user = User::where('email',request()->email)->first();
        if (!$user) {
            return response()->json(['message'=> 'user not found' ],444);
        }
        $user->password = Hash::make(request()->password);
        $user->save();
        return response()->json(['message'=> 'password was reset' ]);
    }

    protected function randToken () {
        $token = rand(10000,99999);
        return (User::where('reset_password_code',$token)->first())?$this->randToken():$token;

    }

    public function resetPasswordMail ($email,$code) {

        $data = array("body" => $code);

        Mail::send('templates.resetPasswordMail', $data, function($message) use ($email) {
            $message->to($email)
                ->subject(' Verification Email ');
            $message->from('no_reply@DayForce.com','DayForce');
        });
        if (Mail::failures()){
            return false;
        }
        return true;
    }
}
