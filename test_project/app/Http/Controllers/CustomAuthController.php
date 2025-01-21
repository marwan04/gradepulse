<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // Determine the user type by email domain
        if (str_contains($email, '@studentdomain.com')) {
            if (auth('student')->attempt(['email' => $email, 'password' => $password])) {
                return redirect('/student-dashboard');
            }
        } elseif (str_contains($email, '@instructordomain.com')) {
            if (auth('instructor')->attempt(['email' => $email, 'password' => $password])) {
                return redirect('/instructor-dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid email domain']);
        }

        // If authentication fails
        return redirect()->back()->withErrors(['email' => 'Invalid credentials or user not found.']);
    }

}
