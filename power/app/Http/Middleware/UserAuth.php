<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
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
        if ( !auth()->guard('user')->check() || auth()->guard('user')->user()->status =='0') {
            return response()->json(['message' => trans('auth.unauthorized')], 401);
        }
        return $next($request);
    }
}
