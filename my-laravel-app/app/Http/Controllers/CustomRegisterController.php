<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomRegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:Student,email',
                'unique:Instructor,email',
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
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).'
        ]);

        $email = $request->email;
        $password = Hash::make($request->password); // ✅ Hash the password before saving
        $id = $request->user_id;

        Log::info("🟢 Registering User: Email - $email | Hashed Password: $password");

        if (str_contains($email, '@studentdomain.com')) {
            $user = Student::create([
                'name' => $request->name,
                'email' => $email,
                'StudentID' => $id,
                'password' => $password,
            ]);
            auth('student')->login($user);
            return redirect('/student-dashboard');
        } elseif (str_contains($email, '@instructordomain.com')) {
            $user = Instructor::create([
                'name' => $request->name,
                'email' => $email,
                'InstructorID' => $id,
                'password' => $password,
            ]);
            auth('instructor')->login($user);
            return redirect('/instructor-dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid email domain']);
    }
}
