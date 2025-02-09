<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                // Explicitly define the table names for uniqueness validation
                'unique:Student,email',
                'unique:Instructor,email',
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $request->email;
        if (!Hash::needsRehash($request->password)) {
            $password = Hash::make($request->password);
        } else {
            $password = $request->password;
        }
        $id = $request->user_id;

        // Handle domain-based logic
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