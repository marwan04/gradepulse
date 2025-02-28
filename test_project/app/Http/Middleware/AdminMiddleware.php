<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is logged in as an instructor
        $user = Auth::guard('instructor')->user();

        // Check if the user exists and has RoleID = 1 (Admin)
        if ($user && $user->roleID == 1) {
            return $next($request);
        }

        // Unauthorized: Logout and redirect to login
        Auth::logout();
        return redirect('/login')->withErrors('Unauthorized access.');
    }
}

