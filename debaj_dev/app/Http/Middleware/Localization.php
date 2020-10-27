<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
      if(\Session::has('front-locale'))
         {
             \App::setlocale(\Session::get('front-locale'));
         }
         return $next($request);
    }
}
