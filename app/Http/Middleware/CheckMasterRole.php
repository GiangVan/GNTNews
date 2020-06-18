<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Http\Enums\AccountRoles;

class CheckMasterRole
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
		if(Auth::user()->role === AccountRoles::MASTER){
			return $next($request);
		}
		abort(403);
    }
}
