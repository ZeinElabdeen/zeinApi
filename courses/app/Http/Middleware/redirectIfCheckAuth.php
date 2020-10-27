<?php

namespace App\Http\Middleware;

use Closure;

class redirectIfCheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $access_token = $request->header('access_token');
        if(Session()->has($access_token)){
            return redirect('api/get-courses');
        }
        return $next($request);
    }
}
