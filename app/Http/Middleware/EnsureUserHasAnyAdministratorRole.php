<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAnyAdministratorRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $roles = ['user'];
        if (auth()->user()->hasRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }
        return $next($request);
    }
}
