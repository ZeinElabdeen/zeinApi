<?php

namespace App\Http\Middleware;

use Closure;

class VendorCheck
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
        if (auth('api')->user()->type == '0'){
            return response()->json(['message' => 'not allowed'],444);
        }
        return $next($request);
    }
}
