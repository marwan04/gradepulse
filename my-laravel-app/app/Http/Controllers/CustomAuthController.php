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
        // ✅ Validate login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        Log::info("🔵 Login Attempt: Email - " . $email);

        /**
         * 🟢 **Student Login Handling**
         * - Uses `auth()->guard('student')->login($user)`
         * - Redirects to `/student-dashboard`
         */
        if (str_contains($email, '@studentdomain.com')) {
            $user = Student::where('email', $email)->select(['StudentID', 'email', 'password'])->first();

            if ($user) {
                Log::info("🟢 Student Found: " . json_encode($user));

                if (Hash::check($password, $user->password)) {
                    Log::info("✅ Password Match!");

                    // ✅ **Login using the 'student' guard**
                    auth()->guard('student')->login($user);

                    Log::info("✅ Student Login Successful - Redirecting to Student Dashboard.");
                    return redirect('/student-dashboard');
                } else {
                    Log::error("❌ Password Mismatch! Entered: " . $password);
                    return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
                }
            }
        }

        /**
         * 🔵 **Instructor Login Handling**
         * - Uses `auth()->guard('instructor')->login($user)`
         * - Redirects instructors/admins accordingly
         */
        elseif (str_contains($email, '@instructordomain.com')) {
            $user = Instructor::where('email', $email)->select(['InstructorID', 'email', 'password', 'RoleID'])->first();

            if ($user) {
                Log::info("🟢 Instructor Found: " . json_encode($user));

                if (Hash::check($password, $user->password)) {
                    Log::info("✅ Password Match!");

                    // ✅ **Login using the 'instructor' guard**
                    auth()->guard('instructor')->login($user);

                    $roleID = intval($user->RoleID);
                    Log::info("🔍 User Role ID: " . $roleID);

                    // ✅ **If RoleID == 1, redirect to admin-dashboard**
                    if ($roleID == 1) {
                        Log::info("✅ Admin Login Successful - Redirecting to Admin Dashboard.");
                        return redirect('/admin-dashboard');
                    }

                    // 🔹 **If not admin, redirect to instructor-dashboard**
                    Log::info("✅ Instructor Login Successful - Redirecting to Instructor Dashboard.");
                    return redirect('/instructor-dashboard');
                } else {
                    Log::error("❌ Password Mismatch! Entered: " . $password);
                    return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
                }
            }
        }

        // ❌ **If email domain does not match or user is not found**
        Log::error("❌ User Not Found.");
        return redirect()->back()->withErrors(['email' => 'Invalid credentials or user not found.']);
    }
}

