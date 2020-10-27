<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\APIS\authApiModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;




class authApiController extends Controller
{

    private function sendSMS($mobile,$message){

        $username = 'KASEDUksa';
        $password = 'kasedu2020';
        $sender = 'KASEDU';
        $date = date('d/m/Y');
        $time = date('H:i');
    
        $api_url="http://www.shamelsms.net/api/httpSms.aspx?username=$username&password=$password&mobile=$mobile&message=$message&sender=$sender&unicodetype=u&date=$date&time=$time";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;


          
    }

    public function register(Request $request)
    {
        $lang = parent::detectLang($request);
        //validate data
        $data['student_name'] = $request->username;
        $data['student_email'] = $request->email;
        $data['student_phone'] = $request->phone;
        $data['student_password'] = $request->password;

        if($lang == '_ar'){
            $valid = validator::make($data,[
                "student_name"=>"required|min:3|max:30",//|regex:/^[a-z ,.-]+$/i
                'student_email'=>'required|unique:students',//|email|regex:/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
                'student_phone'=>'required|unique:students|max:20',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
                'student_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
        ],[
            // 'student_name.regex'=>' الأسم يجب ان يحتوي علي حروف فقط ',
            "student_name.min"=>"الأسم يجب ان يكون أكبر من 3 احرف",
            "student_name.max"=>"الأسم يجب ان يكون اصغر من 30 حرف",
            "student_name.required"=>"يرجي ادخال الأسم",

            // 'student_email.regex'=>'يجب ادخال الايميل بشكل صحيح',
            'student_email.required'=>'يرجي ادخال الايميل',
            'student_email.unique'=>'هذا الايميل موجود بالفعل',
            'student_email.email'=>'يرجي ادخال الايميل بشكل صحيح',

            // 'student_phone.regex'=>' ادخال رقم الجوال بشكل صحيح',
            'student_phone.required'=>'يرجي ادخال رقم الجوال',
            'student_phone.unique'=>'هذا الجوال موجود بالفعل',
            // 'student_phone.min'=>'يجب ان يكون اكبر من 13 رقم',
            'student_phone.max'=>'يجب ان يكون اقل من  20 رقم',


            // 'student_password.regex'=>'كلمه المرور يجب ان تحتوي عل الأقل حروف صغيره و حروف كبيرة و رموز خاصة وارقام',
            'student_password.required'=>'يرجي ادخال كلمه المرور',
            'student_password.min'=>'يجب ان تكون كلمه المرور اكبر من 8 ',
            'student_password.max'=>'يجب ان تكون كلمه المرور اقل من 20',

        ]);

        }else{
            $valid = validator::make($data,[
                "student_name"=>"required|min:3|max:30",//|regex:/^[a-z ,.-]+$/i
                'student_email'=>'required|unique:students',//|email|regex:/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
                'student_phone'=>'required|unique:students|max:20',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
                'student_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
        ],[
            // 'student_name.regex'=>' The name must contain only letters and spaces ',
            // 'student_phone.regex'=>' The phone should be like +20xxxxxxxxx ',
            // 'student_password.regex'=>'Password should contain a capital, a small letter, a special character and a number'
        ]);

        }

        
        if($valid->fails()){
            // return $valid->errors();
            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }

        //create new object to send to model
        $student = new authApiModel;
        $student->student_name = $request->username;
        $student->student_email = $request->email;
        $student->student_phone = $request->phone;
        $student->student_password = bcrypt($request->password);

        $student->activation_code = rand(10000,99999);
        $student->access_token =  Str::random(60);
        //insert new student
        $userID = authApiModel::insertST($student);

        /* sending activation code */
        $mobile = $student->student_phone;
        //     $mobile = '+966556955512';
        $message = 'KASEDU%20Code:%20'. $student->activation_code .'%20Please%20enter%20it%20to%20complete%20your%20registeration.Thanks';
        $data = $this->sendSMS($mobile,$message);
        if (strpos($data, 'Sent') == true) {
            //if sent successfully
            return response()->json(['success'=>true,"result"=>["user_data"=>["access_token"=>$student->access_token]]],200);


        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"خطأ في أرسال الكود","details"=>array()]],401);
        }
        /* end sendign */

        

    
    }


    public function verifyUser(Request $request)
    {

        $access_token = $request->header('access_token');
        // $STID = Session::get($access_token);
        $STID = parent::getUserId($access_token);

        // return $STID;
        $lang = parent::detectLang($request);

        $data['activation_code'] = $request->code;

        if($lang == '_ar'){
            $valid = validator::make($data,[
                "activation_code"=>"required|digits:5|numeric",
    
            ],[
                'activation_code.required'=>"يرجي ادخال كود التفعيل",
                'activation_code.digits'=>"يجب ان يكون كودالتفعيل 5 ارقام ",
                'activation_code.numeric'=>"يجب ان تكون  كود التفعيل ارقام فقط",
            ]);
        }else{
            $valid = validator::make($data,[
                "activation_code"=>"required|digits:5|numeric",
    
            ]);
        }
        
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }

        $student = new authApiModel;
        $student->student_id = $STID;
        
        $activation_code = authApiModel::activateST($student);
        // return $activation_code;
       if($activation_code == $request->code){
            $student->activation_code = $request->code;
            authApiModel::updateActivationST($student);
            //return success with api token
            return response()->json(['success'=>true,"result"=>(object)[]],200);

       }else{
            // return false for matching activation code
            if($lang == '_ar'){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"كود التفعيل غير متطابق","details"=>array()]],401);

            }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"The activation code is not matched","details"=>array()]],401);

       }
    }


    public function resendActivation(Request $request)
    {

        $access_token = $request->header('access_token');
        // $STID = Session::get($access_token);
        $STID = parent::getUserId($access_token);


        $student = new authApiModel;
        $student->activation_code = rand(10000,99999);
        $student->student_id = $STID;

        if(authApiModel::resendActivation($student)){

            return response()->json(['success'=>true,"result"=>(object)[]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>array()]],500);

        };

        
        //send activation to mobile
    }


    public function login(Request $request)
    {

        $lang = parent::detectLang($request);

        $data['student_phone'] = $request->phone;
        $data['student_password'] = $request->password;
        if($lang == '_ar'){
            // return $lang;

            $valid = validator::make($data,[
                'student_phone'=>'required|max:20|exists:students',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
                'student_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
            ],[

                // 'student_phone.regex'=>'يرجي ادخال رقم الجوال بشكل صحيح ',
                'student_phone.required'=>'يرجي ادخال رقم الجوال',
                'student_phone.exists'=>'هذا الجوال غير موجود  ',
                // 'student_phone.min'=>'يجب ان يكون اكبر من 13 رقم',
                'student_phone.max'=>'يجب ان يكون اقل من  20 رقم',
    
    
                // 'student_password.regex'=>'كلمه المرور يجب ان تحتوي عل الأقل حروف صغيره و حروف كبيرة و رموز خاصة وارقام',
                'student_password.required'=>'يرجي ادخال كلمه المرور',
                'student_password.min'=>'يجب ان تكون كلمه المرور اكبر من 8 ',
                'student_password.max'=>'يجب ان تكون كلمه المرور اقل من 20',

            ]);
            
        }else{
            $valid = validator::make($data,[
                'student_phone'=>'required|max:20|exists:students',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
                'student_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
            ],[
                // 'student_password.regex'=>'Password should contain a capital, a small letter, a special character and a number',
                'student_phone.exists'=>'The entered student phone is not exist',
                // 'student_phone.regex'=>' The phone should be like +20xxxxxxxxx ',

            ]);

        }
        
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }

        $student = new authApiModel;
        $student->student_phone = $request->phone;
        // $hashedPass = bcrypt($request->student_password);
        $passwordDB = authApiModel::getPassword($student);

        foreach($passwordDB as $passDB){
            //to get password
            if(password_verify($request->password,$passDB->student_password)){
                // the password is confirmed


                $access_token = Str::random(60);
                //delete old access token if exist to generate new one
                // if($oldAccessToken = array_keys(session()->all(),$passDB->student_id)){
                    // Session()->forget($oldAccessToken[0]);
                    // Session::forget($access_token);
                // }
                // Session()->put($access_token,$passDB->student_id);
                // Session::put($access_token,intval($passDB->student_id));

                authApiModel::updateAccessToken($access_token,$passDB->student_id);

                if($passDB->verification == 1){

                        return response()->json(['success'=>true,"result"=>["user_data"=>["access_token"=>$access_token]]],200);
   
                }else{
                        if($lang == '_ar'){
                            return response()->json(['success'=>false,"error"=>["case"=>2,"message"=>"من فضلك فعل حسابك اولا ","details"=>array()],"result"=>["user_data"=>["access_token"=>$access_token]]],401);

                        }
                        return response()->json(['success'=>false,"error"=>["case"=>2,"message"=>"Please verify your account ","details"=>array()],"result"=>["user_data"=>["access_token"=>$access_token]]],401);
                
                    }
            }else{
                // the password isnont confirmed
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"خطأ في كلمة المرور","details"=>array()]],401);

                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Wrong password","details"=>array()]],401);
            }
        }

    }


    public function verifyPhoneForget(Request $request)
    {
        
        $lang = parent::detectLang($request);
        $data['student_phone'] = $request->phone;
        if($lang == "_ar"){
            $valid = validator::make($data,[
                'student_phone'=>'required|max:20|exists:students',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
            ],[
                'student_phone.exists'=>'هذا الرقم غير موجود',
                // 'student_phone.regex'=>' ادخال رقم الجوال بشكل صحيح',

            ]);
        }else{
            $valid = validator::make($data,[
                'student_phone'=>'required|max:20|exists:students',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
            ],[
                'student_phone.exists'=>'The entered student phone is not exist',
                // 'student_phone.regex'=>' The phone should be like +20xxxxxxxxx ',
            ]);
        }
        
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }

        $student = new authApiModel;
        $student->student_phone = $request->phone;
        if($student_id  = authApiModel::getSTID($student)){

            //delete old access token if exist to generate new one
            // if($oldAccessToken = array_keys(session()->all(),$student_id->student_id)){
                // Session()->forget($oldAccessToken[0]);
                // Session::forget($access_token);
            // }

            // Session()->put($access_token,$student_id->student_id);
            // Session::put($access_token,intval($student_id->student_id));
                /* sending activation code */
            $mobile = $student->student_phone;
            //     $mobile = '+966556955512';
            $message = 'KASEDU%20Code:%20'. $student->activation_code .'%20Please%20enter%20it%20to%20complete%20your%20registeration.Thanks';
            $data = $this->sendSMS($mobile,$message);
            if (strpos($data, 'Sent') == true) {
                //if sent successfully
                $access_token = Str::random(60);
                authApiModel::updateAccessToken($access_token,$student_id->student_id);
                return response()->json(['success'=>true,"result"=>["user_data"=>["access_token"=>$student->access_token]]],200);


            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"خطأ في أرسال الكود","details"=>array()]],401);
            }
        /* end sendign */

            
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please enter your phone again ","details"=>array()]],500);
        }

    }


    public function setNewPass(Request $request)
    {

        $access_token = $request->header('access_token');
        // $STID = Session::get($access_token);
        $STID = parent::getUserId($access_token);


        $lang = parent::detectLang($request);

        $data['student_password'] = $request->new_password;
        if($lang == '_ar'){
            $valid = validator::make($data,[
                'student_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
    
            ],[

                // 'student_password.regex'=>'كلمه المرور يجب ان تحتوي عل الأقل حروف صغيره و حروف كبيرة و رموز خاصة وارقام',
                'student_password.required'=>'يرجي ادخال كلمه المرور',
                'student_password.min'=>'يجب ان تكون كلمه المرور اكبر من 8 ',
                'student_password.max'=>'يجب ان تكون كلمه المرور اقل من 20',
            ]);
        }else{
            $valid = validator::make($data,[
                'student_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
    
            ],[
                // 'student_password.regex'=>'Password should contain a capital, a small letter, a special character and a number'
            ]);
        }
        
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }
        $student = new authApiModel;
        $student->student_password = bcrypt($request->new_password);
        $student->student_id = $STID;

        if(authApiModel::setNewPassword($student)){
            return response()->json(['success'=>true,"result"=>(object)[]],200);
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please enter password again ","details"=>array()]],500);
        }



    }


    public function profile(Request $request)
    {
        
        $access_token = $request->header('access_token');
        // $STID = Session::get($access_token);
        $STID = parent::getUserId($access_token);
        


        
       if($profile = authApiModel::getProfile($STID)){

            $record = [
                            "username"              =>$profile->student_name,
                            "phone"                 =>$profile->student_phone,
                            "email"                 =>$profile->student_email,
          
            ];

        return response()->json(['success'=>true,"result"=>["profile"=>$record]],200);
       }else{
        return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try  again ","details"=>array()]],500);
       }
        
    }

    public function updateProfile(Request $request)
    {

        $lang = parent::detectLang($request);

        $access_token = $request->header('access_token');
        // $STID = Session::get($access_token);
        $STID = parent::getUserId($access_token);


        if($lang == '_ar'){
            $valid = validator::make($request->all(),[
            
                "email"=>['required','email'],//, 'regex:/^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/'
                'username'=>'required|min:3|max:30',//|regex:/^[a-z ,.-]+$/i
            ],[
                // 'email.regex'=>'يجب ادخال الايميل بشكل صحيح',
                'email.required'=>'يرجي ادخال الايميل',
                'email.email'=>'يرجي ادخال الايميل بشكل صحيح',

                // 'username.regex'=>' الأسم يجب ان يحتوي علي حروف فقط ',
                "username.min"=>"الأسم يجب ان يكون أكبر من 3 احرف",
                "username.max"=>"الأسم يجب ان يكون اصغر من 30 حرف",
                "username.required"=>"يرجي ادخال الأسم",
    

            ]);
        }else{
            $valid = validator::make($request->all(),[
            
                "email"=>['required','email'], //, 'regex:/^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/'
                'username'=>'required|min:3|max:30|regex:/^[a-z ,.-]+$/i',
            ],[
                // 'email.regex'=>'Please enter valid email'
            ]);
        }
        
        if($valid->fails()){
            // return $valid->errors();
            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                foreach($vs as $val)
                {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);
                    
                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }

        $student = new authApiModel;
        $student->student_name = $request->username;
        $student->student_email = $request->email;
        $student->student_id = $STID;
        // return $student;

        try {
            if(authApiModel::updateProfileData($student)){
                return response()->json(['success'=>true,"result"=>(object)[]],200);
    
            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>" No changes happened ","details"=>array()]],500);
            }
        } 
        catch (QueryException $e) {

            $errorCode = $e->getCode();
            if($errorCode == 23000){

                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>" The email has been already taken ","details"=>array()]],500);
            }
            
        }

        

    }

    public function changePassword(Request $request)
    {

        $lang = parent::detectLang($request);
        $access_token = $request->header('access_token');
        // $STID = Session::get($access_token);
        $STID = parent::getUserId($access_token);


       if($lang == '_ar'){
            $valid = validator::make($request->all(),[
                "old_password"=>"required|min:8|max:20|",
                'new_password'=>'required|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
            ],[
                'old_password.required'=>'يرجي ادخال كلمه المرور',
                'old_password.min'=>'يجب ان تكون كلمه المرور اكبر من 8 ',
                'old_password.max'=>'يجب ان تكون كلمه المرور اقل من 20',

                // 'new_password.regex'=>'كلمه المرور يجب ان تحتوي عل الأقل حروف صغيره و حروف كبيرة و رموز خاصة وارقام',
                'new_password.required'=>'يرجي ادخال كلمه المرور',
                'new_password.min'=>'يجب ان تكون كلمه المرور اكبر من 8 ',
                'new_password.max'=>'يجب ان تكون كلمه المرور اقل من 20',

            ]);
       }else{
            $valid = validator::make($request->all(),[
                "old_password"=>"required|min:8|max:20|",
                'new_password'=>'required|min:8|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            ],[
                'new_password.regex'=>'Password should contain a capital, a small letter, a special character and a number'
            ]);
       }
        if($valid->fails()){
            // return $valid->errors();
            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                foreach($vs as $val)
                {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);
                    
                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }

        if($getST = authApiModel::getProfile($STID)){
            // return $getST->student_password;
            if(password_verify($request->old_password,$getST->student_password)){
                // return "done";
                $student = new authApiModel;
                $student->student_password = bcrypt($request->new_password);
                $student->student_id = $STID;
                if(authApiModel::setNewPassword($student)){
                    return response()->json(['success'=>true,"result"=>(object)[]],200);
                }else{
                    if($lang == '_ar'){
                        return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"يرجي ادخال كلمه المرور مره اخري","details"=>array()]],500);
                    }
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please enter password again ","details"=>array()]],500);
                }
            }else{
                // the password isnont confirmed
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"كلمه المرور خطأ","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Wrong password","details"=>array()]],401);
            }

        }


    }

    public function logout(Request $request)
    {
        $access_token = $request->header('access_token');
        // session()->forget($access_token);
        // Session::forget($access_token);
        authApiModel::logout($access_token);
        return response()->json(['success'=>true,"result"=>(object)[]],200);
    
    }

    public function allUsers()
    {
        $usres =  authApiModel::getAllUsers();
        return $usres;
    }
    public function saveFCM(Request $request)
    {
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $data['fcm_token'] = $request->fcm_token;
        $valid = validator::make($data,[
            "fcm_token"=>"required|unique:students",
        ]);

        if($valid->fails()){
            // return $valid->errors();
            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {
                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);
                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }
        authApiModel::updateFCM($data['fcm_token'],$STID);
        return response()->json(['success'=>true,"result"=>(object)[]],200);
        
    }

    public function changeLang(Request $request)
    {
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);

        $data['lang'] = $request->lang;
        $valid = validator::make($data,[
            "lang"=>"required|min:2|max:2",
        ]);

        if($valid->fails()){
            // return $valid->errors();
            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {
                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);
                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }
        authApiModel::updateLang($data['lang'],$STID);
        return response()->json(['success'=>true,"result"=>(object)[]],200);
        
    }

    public function allNotifications(Request $request)
    {
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);


        if($notifications = authApiModel::getAllNotifications($STID)){

            if($notifications->isEmpty()){
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لاتوجد اشعارات  حاليا","details"=>array()]],401);

                }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No notifications currently","details"=>array()]],401);
            }


            $notiRecord = array();
            $allNoti = array();

            foreach ($notifications as $key => $value) {
                $notiRecord = [
                    "notification_id"       =>intval($value->id),
                    "reservation_id"        =>intval($value->reservation_id),
                    "title"                 =>$value->{'title'.$lang},
                    "details"               =>$value->{'details'.$lang},
                    "noti_created_at"       =>$value->noti_created_at,
                    "read"                  =>intval($value->read),

                    
                ];
                array_push($allNoti,$notiRecord);
            }


        return response()->json(['success'=>true,"result"=>["all_noti"=>$allNoti]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>""]],500);
        }

    }
    
    // public function testNotify(Request $request)
    // {
    //     $access_token = $request->header('access_token');
    //     $STID = parent::getUserId($access_token);

    //     $FCMToken = authApiModel::getFCM($STID);
    //     $title = 'compelete resercation';
    //     $desc = 'first notification description';
    //     $result = parent::senNotificationToSingleUser($FCMToken, $title, $desc);
    //     return $result;
    //     // return response()->json(['success'=>true,"result"=>(object)[]],200);
    // }






}

