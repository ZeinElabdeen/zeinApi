<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Closure;
use Illuminate\support\Facades\Request;
use Illuminate\Support\Facades\Session;

class checkAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$parameter = null)
    {
        
         //parameter for use this middleware in to cases if authentication is requrired or is optional
        //  $headers = apache_request_headers();
        //  dd($headers['access_token']);
        //  return response()->json(["access_token"=>$headers['access_token']],200);
        $access_token = [];
        $access_token['access_token'] = $request->header('access_token');

        if($parameter == 'done'){
            //auth requried

           $valid = validator::make($access_token,[
               'access_token'=>'required|exists:students',
           ]);
           if($valid->fails()){
               //if there is error abort 401
               // return Request::header('access_token');
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
                   return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
               }
           }
           //move to next request
           return $next($request);
        }


        //auth is optional
       $valid = validator::make($access_token,[
           'access_token'=>'exists:students',
       ]);
       if($valid->fails()){
           //if there is error abort 401
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
               return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
           }
       }
       //move to next request
       return $next($request);
         
        
            
    }
}
