<?php

namespace App\Http\Middleware;

use Closure;

class Vendor
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
        if ( !auth()->guard('users')->check() || auth()->guard('users')->user()->type !='1') {
            return redirect('my-account');
        }
        return $next($request);
    }
}
