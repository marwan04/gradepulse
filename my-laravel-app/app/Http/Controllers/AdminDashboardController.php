<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ✅ Get counts for dashboard statistics
        $courses_count = Course::count();
        $instructors_count = Instructor::count();
        $students_count = Student::count();
        $admins_count = Instructor::where('RoleID', 1)->count(); // ✅ Ensure admin count exists

        // ✅ Retrieve all courses (if needed for listing)
        $courses = Course::all();

        // ✅ Pass all required data to the view
        return view('admin.dashboard', compact(
            'courses_count', 
            'instructors_count', 
            'students_count', 
            'admins_count', 
            'courses'
        ));
    }
}
