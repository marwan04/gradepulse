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

        // 🟢 Student Login
        if (str_contains($email, '@studentdomain.com')) {
            $user = Student::where('email', $email)->first();
            if ($user && Hash::check($password, $user->password)) {
                Log::info("Student Login Successful");
                auth()->guard('student')->login($user);
                return redirect('/student-dashboard');
            } else {
                Log::error("Student Login Failed: Incorrect credentials");
                return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
            }
        }

        // 🔵 Instructor & Admin Login
	// 🔵 Instructor & Admin Login
elseif (str_contains($email, '@instructordomain.com')) {
    $user = Instructor::where('email', $email)->first();

    if ($user) {
        Log::info("User Found: " . json_encode($user));

        if (Hash::check($password, $user->password)) {
            Log::info("Password Match!");
            auth()->guard('instructor')->login($user);

            // ✅ Convert RoleID to integer for safety
            $roleID = intval($user->RoleID);
            Log::info("User Role ID: " . $roleID);

            // ✅ Correct Admin Redirection
            if ($roleID === 1) {
                Log::info("Admin Login Successful - Redirecting to Admin Dashboard.");
                return redirect('/admin-dashboard');
            }

            // ✅ Instructor Redirection
            Log::info("Instructor Login Successful - Redirecting to Instructor Dashboard.");
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

