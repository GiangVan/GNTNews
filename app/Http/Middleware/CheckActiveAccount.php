<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckActiveAccount
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
        if(!Auth::user()->is_blocked){
			return $next($request);
		} else {
			return redirect('logout');
		}
    }
}
