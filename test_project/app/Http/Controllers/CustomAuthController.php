<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use App\Models\Instructor;

class CustomAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        Log::info("Login Attempt: Email - " . $email);

        if (str_contains($email, '@studentdomain.com')) {
            $user = Student::where('email', $email)->first();
            if ($user) {
                Log::info("User Found: " . json_encode($user));
                if (Hash::check($password, $user->password)) {
                    Log::info("Password Match!");
                    auth()->guard('student')->login($user);
                    return redirect('/student-dashboard');
                } else {
                    Log::error("Password Mismatch!");
                    return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
                }
            }
        } elseif (str_contains($email, '@instructordomain.com')) {
            $user = Instructor::where('email', $email)->first();
            if ($user) {
                Log::info("User Found: " . json_encode($user));
                if (Hash::check($password, $user->password)) {
                    Log::info("Password Match!");
                    auth()->guard('instructor')->login($user);
                    return redirect('/instructor-dashboard');
                } else {
                    Log::error("Password Mismatch!");
                    return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
                }
            }
        }

        Log::error("User Not Found.");
        return redirect()->back()->withErrors(['email' => 'Invalid credentials or user not found.']);
    }
}
