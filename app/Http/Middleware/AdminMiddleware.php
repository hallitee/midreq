<?php

namespace App\Http\Middleware;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Closure;

class AdminMiddleware
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
		
		if ( Auth::check() && Auth::user()->isAdmin() == 1)
        {
            return $next($request);
        }
		else{
			
			return redirect('login');
		}
	
			
		
    }
}
