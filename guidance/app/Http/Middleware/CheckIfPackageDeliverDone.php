<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;

class CheckIfPackageDeliverDone
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
        $package = Order::findOrFail($request->id);
        if ($package->status == 3) {
            return response()->json(['message' => trans('collection.package.pending')], 444);
        }
        return $next($request);
    }
}
