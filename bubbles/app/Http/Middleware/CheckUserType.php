<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use Closure;

class CheckUserType extends ResponseController
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
        if (auth('api')->user()->type != '3') {
            if(auth('api')->user()->type == '2') {
                return $this->apiResponse(['message' => trans('response.membership_waiting')],444);
            }
            return $this->apiResponse(['message' => trans('response.buy_membership')],444);
        }

        return $next($request);
    }
}
