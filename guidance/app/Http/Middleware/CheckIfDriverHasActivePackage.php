<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfDriverHasActivePackage
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
        if ( auth('driver')->user()->activePackage) {
            return response()->json(['message' => trans('collection.package.has_package')], 444);
        }
        return $next($request);
    }
}
