<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_suspended) {
			auth()->guard('web')->logout() ;    
			$message = 'Your account has been suspended. Please contact administrator.';
			return redirect()->route('login')->withMessage($message); 
        }
        return $next($request);
    }
}
