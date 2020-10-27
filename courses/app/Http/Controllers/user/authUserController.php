<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\models\user\authUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Contracts\Filesystem\FileNotFoundException;




class authUserController extends Controller
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
    public function index(Request $request)
    {
        if($redirect = $request->header('referer')){
            Session()->put('redirect',$redirect);
        }else{
            Session()->put('redirect','/');
        }
        // return Session()->all();

        $lang = parent::detectUserLang();

        if(Session()->has('user')){
            $profile = authUserModel::getProfile(Session()->get('user_id'));

            if($lang == '_ar'){
                return view('user.ar.profile',[
                    'profile'=>$profile
                ]);
            }else{
                return view('user.en.profile',[
                    'profile'=>$profile
                ]);
            }
        }else{
            if($lang == '_ar'){
                return view('user.ar.login');
            }else{
                return view('user.en.login');
            }
        }
        
    }
    public function login(Request $request)
    {

        $lang = parent::detectUserLang();

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
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $student = new authUserModel;
        $student->student_phone = $request->phone;
        // $hashedPass = bcrypt($request->student_password);
        $passwordDB = authUserModel::getPassword($student);

        foreach($passwordDB as $passDB){
            //to get password
            if(password_verify($request->password,$passDB->student_password)){
                // the password is confirmed

                // $access_token = Str::random(60);
                if($passDB->verification == 1){

                        //delete old access token if exist to generate new one
                        
                        Session()->put('user',$passDB->student_name);
                        Session()->put('user_id',$passDB->student_id);
                        return redirect(Session()->get('redirect'));
                        // return Session()->all();
   
                }else{
                        $href =  URL::temporarySignedRoute(
                            'verify', now()->addMinutes(60), ['user_id' => $passDB->student_id]
                        );
                        return redirect($href);         
                    }
            }else{
                // the password isnont confirmed
                if($lang == '_ar'){
                    return redirect()->back()->with('Error','خطأ في كلمة المرور');
                }
                return redirect()->back()->with('Error',' Password is wrong');
            }
        }

    }

    public function updateProfile(Request $request)
    {

        $lang = parent::detectUserLang();
        $STID = Session()->get('user_id');
        if($request->has('insertFirst')){
            $data['student_passport_name'] = $request->passportName;
            $data['student_passport_number'] = $request->passportNumber;
            $data['passport_photo'] = $request->passportPhoto;
    
            if($lang == '_ar'){
                $valid = validator::make($data,[
                    "student_passport_name" =>"required|max:50",
                    "student_passport_number"=>"required|numeric|unique:students",
                    "passport_photo"        =>"required|image",
            ],[
    
                "student_passport_name.required" =>"يجب ادخال الاسم ",
                "student_passport_name.max" =>"يجب الا يزيد الاسم عن 50 حرف",
                "student_passport_number.required" =>"يجب ادخال رقم جواز السفر",
                "student_passport_number.unique" =>"هذا الرقم تم ادخاله من قبل",
                "student_passport_number.numeric" =>"يجب ان يحتوي علي ارقام فقط",
                "passport_photo.required" =>"يجب ادخال صوره جواز السفر ",
                "passport_photo.image" =>"هذا الملف غير صحيح",
    
            ]);
    
            }else{
                $valid = validator::make($data,[
                    "student_passport_name" =>"required|max:50",
                    "student_passport_number"=>"required|numeric|unique:students",
                    "passport_photo"        =>"required|image",
                ]);
    
            }
            
            if($valid->fails()){
                return redirect()->back()->withErrors($valid)->withInput();
            }

            try{
            $file_name= time() . '.' . $request->passportPhoto->extension();
            $request->passportPhoto->move(storage_path('app/public/images/passports'), $file_name);
            $data['passport_photo'] = $file_name;
            }catch(FileNotFoundException $e){
                    return 'please try again';
            }
            if(authUserModel::updatePassport($data,$STID)){
                return redirect(Session()->get('redirect'));
            }
            abort(501);

        }else{
            $data['student_name'] = $request->name;
            $data['student_email'] = $request->email;
            $data['student_passport_name'] = $request->passportName;
            $data['student_passport_number'] = $request->passportNumber;
            $data['passport_photo'] = $request->passportPhoto;
    
            if($lang == '_ar'){
                $valid = validator::make($data,[
                    "student_name"=>"required|min:3|max:30",//|regex:/^[a-z ,.-]+$/i
                    'student_email'=>'required|email',//|regex:/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
                    "student_passport_name" =>"required|max:50",
                    "student_passport_number"=>"required|numeric",
                    "passport_photo"        =>"required|image",
            ],[
                // 'student_name.regex'=>' الأسم يجب ان يحتوي علي حروف فقط ',
                "student_name.min"=>"الأسم يجب ان يكون أكبر من 3 احرف",
                "student_name.max"=>"الأسم يجب ان يكون اصغر من 30 حرف",
                "student_name.required"=>"يرجي ادخال الأسم",
    
                'student_email.regex'=>'يجب ادخال الايميل بشكل صحيح',
                'student_email.required'=>'يرجي ادخال الايميل',
                'student_email.email'=>'يرجي ادخال الايميل بشكل صحيح',
    
                "student_passport_name.required" =>"يجب ادخال الاسم ",
                "student_passport_name.max" =>"يجب الا يزيد الاسم عن 50 حرف",
                "student_passport_number.required" =>"يجب ادخال رقم جواز السفر",
                "student_passport_number.numeric" =>"يجب ان يحتوي علي ارقام فقط",
                "passport_photo.required" =>"يجب ادخال صوره جواز السفر ",
                "passport_photo.image" =>"هذا الملف غير صحيح",
    
            ]);
    
            }else{
                $valid = validator::make($data,[
                    "student_name"=>"required|min:3|max:30",//|regex:/^[a-z ,.-]+$/i
                    'student_email'=>'required|email',//|regex:/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
                    "student_passport_name" =>"required|max:50",
                    "student_passport_number"=>"required|numeric",
                    "passport_photo"        =>"required|image",
                ]);
    
            }
            
            if($valid->fails()){
                return redirect()->back()->withErrors($valid)->withInput();
            }

            if($request->passportPhoto){
                $request->validate([
                    'old_photo_name'            => 'required',
                    
                ]);
                //move photo to server 
                if($request->old_photo_name !== 'default.jpg'){
                    Storage::delete('public/images/passports/'.$request->old_photo_name);
                }
                try{
                $file_name= time() . '.' . $request->passportPhoto->extension();
                $request->passportPhoto->move(storage_path('app/public/images/passports'), $file_name);
                $data['passport_photo'] = $file_name;
                }catch(FileNotFoundException $e){
                    return 'please try again';
                }

                try {
                    authUserModel::updatePassport($data,$STID);
                    if($lang == '_ar'){
                        return redirect()->back()->with('Success','تم التعديل بنجاح');          
                    }else{
                        return redirect()->back()->with('Success','Successfully Updated');          
                    }
                } 
                catch (QueryException $e) {
        
                    $errorCode = $e->getCode();
                    $errorMessage = $e->getMessage();
                    if($errorCode == 23000){
                        if (strpos($errorMessage, "key 'student_passport_number'") !== false) {
                            return redirect()->back()->with('Error','Paasport Number is already exists');  
                        }if (strpos($errorMessage, "key 'student_email'") !== false){
                            return redirect()->back()->with('Error','Email  is already exists');  
                        }
                    }
                    
                }

            }

            

               
        }

       



    } 

    public function registerIndex(Request $request)
    {
       
        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            return view('user.ar.register');
        }else {
            return view('user.en.register');
        }

    }

    public function register(Request $request)
    {
        $lang = parent::detectUserLang();

        $data['student_name'] = $request->name;
        $data['student_email'] = $request->email;
        $data['student_phone'] = $request->phone;
        $data['student_password'] = $request->password;
        $data['password_confirmation'] = $request->confirmPassword;
        if($lang == '_ar'){
            $valid = validator::make($data,[
                "student_name"=>"required|min:3|max:30",//|regex:/^[a-z ,.-]+$/i
                'student_email'=>'required|unique:students',//|email|regex:/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
                'student_phone'=>'required|unique:students|max:20',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
                'student_password'=>'required|required_with:password_confirmation|same:password_confirmation|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
                "password_confirmation"=>"required"
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
            'student_password.required_with'=>"يجب تأكيد كلمة المرور",
            "student_password.same"=>"كلمة المرور غير متطابقة "

        ]);

        }else{
            $valid = validator::make($data,[
                "student_name"=>"required|min:3|max:30",//|regex:/^[a-z ,.-]+$/i
                'student_email'=>'required|unique:students|email',//|regex:/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
                'student_phone'=>'required|unique:students|max:20',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
                'student_password'=>'required|required_with:password_confirmation|same:password_confirmation|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
                "password_confirmation"=>"required"
            ],[
            // 'student_name.regex'=>' The name must contain only letters and spaces ',
            // 'student_phone.regex'=>' The phone should be like +20xxxxxxxxx ',
            // 'student_password.regex'=>'Password should contain a capital, a small letter, a special character and a number'
        ]);

        }
        
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $data['student_password'] = bcrypt($request->password);
        $data['activation_code'] = rand(10000,99999);

        $studentData = Arr::except($data, ['password_confirmation']);
        // return $studentData;
        // 
        if($student_id = authUserModel::register($studentData)){


            /* sending activation code */
            $mobile = $data['student_phone'];
            //     $mobile = '+966556955512';
            $message = 'KASEDU%20Code:%20'. $data['activation_code'] .'%20Please%20enter%20it%20to%20complete%20your%20registeration.Thanks';
            $data = $this->sendSMS($mobile,$message);
            if (strpos($data, 'Sent') == true) {
                //if sent successfully
                $href =  URL::temporarySignedRoute(
                    'verify', now()->addMinutes(60), ['user_id' => $student_id]
                );
                return redirect($href);

            }else{
                return redirect()->back()->with('Error','خطأ في أرسال الكود');
            }
            /* end sendign */

            
            

        }

    }

    public function getVerifyUser(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
         $forget = 0;
        if($request->has('forget')){
            $forget = $request->forget;
        }
        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            return view('user.ar.verifyUser',[
                'user_id'=>$request->user_id,
                'forget'=>$forget,
            ]);
        }else {
            return view('user.en.verifyUser',[
                'user_id'=>$request->user_id,
                'forget'=>$forget,
            ]);

        }
    }
    

    public function verifyUser(Request $request)
    {

        $lang = parent::detectUserLang();
        // return $request->all();
        $data['activation_code'] = $request->verify;
        $data['student_id'] = $request->STID;
        if($lang == '_ar'){
            $valid = validator::make($data,[
                "activation_code"=>"required|digits:5|numeric|exists:students",
                "student_id"=>"required|numeric|exists:students"
    
            ],[
                'activation_code.required'=>"يرجي ادخال كود التفعيل",
                'activation_code.digits'=>"يجب ان يكون كودالتفعيل 5 ارقام ",
                'activation_code.numeric'=>"يجب ان تكون  كود التفعيل ارقام فقط",
                'activation_code.numeric'=>" هذا الكود غير صحيح ",
                'activation_code.exists'=>'هذا الكود غير صحيح'
            ]);
        }else{
            $valid = validator::make($data,[
                "activation_code"=>"required|digits:5|numeric|exists:students",
    
            ]);
        }
        
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();

        }

        $student = authUserModel::getProfile($data['student_id']);
        // return $student->activation_code;
       if($student->activation_code == $data['activation_code']){

        if($request->forget == 1){
            $href =  URL::temporarySignedRoute(
                'forget', now()->addMinutes(60), ['user_id' => $student->student_id]
            );
            return redirect($href);
        }else{
            authUserModel::updateVerificationStatus($data);
            Session()->put('user',$student->student_name);
            Session()->put('user_id',$student->student_id);
            return redirect('/');
        }
            


       }else{
            // return false for matching activation code
            if($lang == '_ar'){
                return redirect()->back()->with('Error'," هذا الكود غير صحيح ");

            }
            return redirect()->back()->with('Error',"ًWrong Activation Code");

       }
    }

    
    public function getVerifyPhone()
    {
        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            return view('user.ar.verifyPhone');
        }else {
            return view('user.en.verifyPhone');
        }
    }

    public function verifyPhone(Request $request)
    {
        // return $request->all();

        $lang = parent::detectUserLang();
        $data['student_phone'] = $request->phone;
        if($lang == '_ar'){
            $valid = validator::make($data,[
                'student_phone'=>'required|max:20|exists:students',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
    
            ],[
               // 'student_phone.regex'=>'يرجي ادخال رقم الجوال بشكل صحيح ',
               'student_phone.required'=>'يرجي ادخال رقم الجوال',
               'student_phone.exists'=>'هذا الجوال غير موجود  ',
               // 'student_phone.min'=>'يجب ان يكون اكبر من 13 رقم',
               'student_phone.max'=>'يجب ان يكون اقل من  20 رقم',
   
            ]);
        }else{
            $valid = validator::make($data,[
                'student_phone'=>'required|max:20|exists:students',//|min:13|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/
    
            ]);
        }
        
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();

        }
        $data['activation_code'] = rand(10000,99999);
        $student = authUserModel::updateActivationCode($data);

         /* sending activation code */
         $mobile = $student->student_phone;
         //     $mobile = '+966556955512';
         $message = 'KASEDU%20Code:%20'. $data['activation_code'] .'%20Please%20enter%20it%20to%20complete%20your%20registeration.Thanks';
         $data = $this->sendSMS($mobile,$message);
         if (strpos($data, 'Sent') == true) {
             //if sent successfully
             $href =  URL::temporarySignedRoute(
                'verify', now()->addMinutes(60), ['user_id' => $student->student_id,'forget'=>1]
            );
            return redirect($href);

         }else{
             return redirect()->back()->with('Error','خطأ في أرسال الكود');
         }
         /* end sendign */
        

        

    }

    public function getForgetPassword(Request $request)
    {
        // return $request->all();
        authUserModel::resetPasswordSignture($request->signature,$request->user_id);
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            return view('user.ar.forgetPassword',[
                'user_id'=>$request->user_id,
                'signature'=>$request->signature
            ]);
        }else {
            return view('user.en.forgetPassword',[
                'user_id'=>$request->user_id,
                'signature'=>$request->signature

            ]);

        }
    }

    public function forgetPassword(Request $request)
    {
        // return $request->all();
        $lang = parent::detectUserLang();
        $data['student_password'] = $request->password;
        $data['password_confirmation'] = $request->password_confirmation;
        $data['student_id'] = $request->user_id;
        $data['reset_token'] = $request->signature;
        if($lang == '_ar'){
            $valid = validator::make($data,[
                'student_password'=>'required|required_with:password_confirmation|same:password_confirmation|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
                "password_confirmation"=>"required",
                "student_id"=>"required|numeric|exists:students",
                "reset_token"=>"required|exists:pass_resets",

        ],[
       
            'student_password.required'=>'يرجي ادخال كلمه المرور',
            'student_password.min'=>'يجب ان تكون كلمه المرور اكبر من 8 ',
            'student_password.max'=>'يجب ان تكون كلمه المرور اقل من 20',
            'student_password.required_with'=>"يجب تأكيد كلمة المرور",
            "student_password.same"=>"كلمة المرور غير متطابقة "

        ]);

        }else{
            $valid = validator::make($data,[
                'student_password'=>'required|required_with:password_confirmation|same:password_confirmation|min:8|max:20',//|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
                "password_confirmation"=>"required",
                "student_id"=>"required|numeric|exists:students",
                "reset_token"=>"required|exists:pass_resets",
            ],[
            // 'student_password.regex'=>'Password should contain a capital, a small letter, a special character and a number'
        ]);
        }

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data['student_password'] = bcrypt($request->password);
        $student = authUserModel::resetPassword($data);
        Session()->put('user',$student->student_name);
        Session()->put('user_id',$student->student_id);
        return redirect('/');
           

        
    }
    

    public function logout(Request $request)
    {
        Session()->forget('user');
        Session()->forget('user_id');
        return redirect(Session()->get('redirect'));

    }
}
