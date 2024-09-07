<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'user')) {       
            return $next($request);
        }
        
        return redirect('login')->with('error', 'You have not user access');
    }
}

