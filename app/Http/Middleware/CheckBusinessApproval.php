<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBusinessApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->hasRole('business')) {
            $business = optional($user->business);
           
            if ($business->status === 'pending') {
                session()->flash('warning', 'Your business account is pending approval. Some features may be restricted.');
            }
              
            if ($business->status === 'rejected' && !$request->route()->named('user.update-business')) {
                return redirect()->route('user.update-business')
                    ->with('error', 'Your business account was rejected. Please update your details.');
            }
    
            if ($business->status !== 'approved' && !$request->route()->named(['user.dashboard', 'user.update-business'])) {
                return redirect()->route('user.dashboard')->with('error', 'Access denied. Your business account is not yet approved.');
            }
        }
    
        return $next($request);
    }
}
