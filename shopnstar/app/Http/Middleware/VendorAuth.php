<?php

namespace App\Http\Middleware;

use Closure;

class VendorAuth
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
        if ( !auth()->guard('vendor')->check() ) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
