<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('instructor')->check() && Auth::guard('instructor')->user()->RoleID == 1) {
            return $next($request);
        }
        return redirect('/instructor-dashboard')->with('error', 'Access denied.');
    }
}
