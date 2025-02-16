<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; // ✅ Import Course model

class InstructorDashboardController extends Controller
{
    public function index()
    {
        $courses = Course::all(); // ✅ Fetch all courses
        return view('instructor.dashboard', compact('courses')); // ✅ Pass courses to the view
    }
}

