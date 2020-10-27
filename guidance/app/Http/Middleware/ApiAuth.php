<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        if ( !auth()->guard('api')->check() || auth()->guard('api')->user()->status =='0') {
            return response()->json(['message' => trans('auth.unauthorized')], 401);
        }
        return $next($request);
    }
}
