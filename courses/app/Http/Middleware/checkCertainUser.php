<?php

namespace App\Http\Middleware;

use Closure;

class checkCertainUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$student_id)
    {

        if($request->session()->has('user_id')){
            if($student_id){
                if ($request->session()->get('user_id') == $request->route($student_id)) {
                    return $next($request);
                }
                return redirect()->back();
            }
            return $next($request);
            
        }
        return redirect('/');
    }
}
