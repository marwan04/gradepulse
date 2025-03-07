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

        Log::info("🔵 Login Attempt: Email - " . $email);

        // 🟢 **تسجيل دخول الطالب**
// 🟢 تسجيل دخول الطالب
if (str_contains($email, '@studentdomain.com')) {
    $user = Student::where('email', $email)->first();

    if ($user && Hash::check($password, $user->password)) {
        auth()->login($user); // ✅ بدون استخدام حارس guard
        return redirect('/student-dashboard');
    } else {
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }
}

        // 🔵 **تسجيل دخول المدرس/المشرف**
        elseif (str_contains($email, '@instructordomain.com')) {
            $user = Instructor::where('email', $email)->select(['InstructorID', 'email', 'password', 'RoleID'])->first();

            if ($user) {
                Log::info("🟢 Instructor Found: " . json_encode($user));

                if (Hash::check($password, $user->password)) {
                    Log::info("✅ Password Match!");

                    auth()->guard('instructor')->login($user);

                    $roleID = intval($user->RoleID);
                    Log::info("🔍 User Role ID: " . $roleID);

                    // ✅ **إذا كان RoleID == 1 يتم التوجيه إلى admin-dashboard**
                    if ($roleID == 1) {
                        Log::info("✅ Admin Login Successful - Redirecting to Admin Dashboard.");
                        return redirect('/admin-dashboard');
                    }

                    // 🔹 **إذا لم يكن مشرفًا، يتم توجيهه إلى instructor-dashboard**
                    Log::info("✅ Instructor Login Successful - Redirecting to Instructor Dashboard.");
                    return redirect('/instructor-dashboard');
                } else {
                    Log::error("❌ Password Mismatch! Entered: " . $password);
                    return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
                }
            }
        }

        Log::error("❌ User Not Found.");
        return redirect()->back()->withErrors(['email' => 'Invalid credentials or user not found.']);
    }
}
 
