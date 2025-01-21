<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($role === 'student' && $user instanceof \App\Models\Student) {
            return $next($request);
        }

        if ($role === 'instructor' && $user instanceof \App\Models\Instructor) {
            return $next($request);
        }

        return redirect('/login')->withErrors('Unauthorized access.');
    }
}
