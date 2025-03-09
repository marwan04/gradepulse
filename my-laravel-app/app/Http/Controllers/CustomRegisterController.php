<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomRegisterController extends Controller
{
    /**
     * ✅ Handle User Registration
     * This function registers students and instructors based on their email domain.
     *
     * - Students (`@studentdomain.com`) → Redirects to `/student-dashboard`
     * - Instructors (`@instructordomain.com`) → Redirects to `/instructor-dashboard`
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // ✅ Validate registration input fields
        $request->validate([
            'name'     => 'required|string|max:255', // Name is required
            'email'    => [
                'required',
                'email',
                'max:255',
                'unique:Student,email',   // Ensure email is not already used by a student
                'unique:Instructor,email' // Ensure email is not already used by an instructor
            ],
            'password' => [
                'required',
                'string',
                'min:8',              // ✅ Minimum 8 characters
                'regex:/[A-Z]/',      // ✅ At least one uppercase letter
                'regex:/[a-z]/',      // ✅ At least one lowercase letter
                'regex:/[0-9]/',      // ✅ At least one number
                'regex:/[@$!%*?&]/',  // ✅ At least one special character
                'confirmed',          // ✅ Ensure password confirmation matches
            ],
        ], [
            // ✅ Custom error message for password complexity
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).'
        ]);

        $email = $request->email;
        $password = Hash::make($request->password); // ✅ Hash the password before storing it
        $id = $request->user_id; // Retrieve user ID input

        Log::info("🟢 Registering User: Email - $email | Hashed Password: $password");

        /**
         * 🟢 **Student Registration**
         * - If email belongs to student domain (`@studentdomain.com`)
         * - Creates a student account and logs them in
         */
        if (str_contains($email, '@studentdomain.com')) {
            $user = Student::create([
                'name'      => $request->name,
                'email'     => $email,
                'StudentID' => $id,
                'password'  => $password,
            ]);

            auth('student')->login($user);
            return redirect('/student-dashboard');
        }

        /**
         * 🔵 **Instructor Registration**
         * - If email belongs to instructor domain (`@instructordomain.com`)
         * - Creates an instructor account and logs them in
         */
        elseif (str_contains($email, '@instructordomain.com')) {
            $user = Instructor::create([
                'name'         => $request->name,
                'email'        => $email,
                'InstructorID' => $id,
                'password'     => $password,
            ]);

            auth('instructor')->login($user);
            return redirect('/instructor-dashboard');
        }

        // ❌ **If email domain is invalid, return an error**
        return redirect()->back()->withErrors(['email' => 'Invalid email domain']);
    }
}

