<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Validator;
use Closure;

class CheckOrderDone
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
        Validator::make(['id' => request()->id],['id'=> 'required|integer|exists:orders,id,status,!='.'3'])->validate();
        $package = Order::findOrFail($request->id);
        if ($package->status == 3) {
            return response()->json(['message' => trans('collection.order.pending')], 444);
        }
        return $next($request);
    }
}
