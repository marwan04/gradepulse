<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckDefaultPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Define default passwords
        $defaultPasswords = [
            'student' => 'default123!',
            'instructor' => 'Default123!',
        ];

        // If logged-in user has a default password, force change
        if ($user && (
            (Auth::guard('student')->check() && Hash::check($defaultPasswords['student'], $user->password)) ||
            (Auth::guard('instructor')->check() && Hash::check($defaultPasswords['instructor'], $user->password))
        )) {
            return redirect()->route('password.change')->with('error', 'You must change your default password.');
        }

        return $next($request);
    }
}

