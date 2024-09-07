<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the correct role
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }
    
        // Redirect to login if not authenticated or role doesn't match
        return redirect('/login');
    }
}
