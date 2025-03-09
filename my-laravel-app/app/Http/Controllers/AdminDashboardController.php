<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Plan;

class AdminDashboardController extends Controller
{
    /**
     * ✅ Display the Admin Dashboard
     * This function retrieves statistics and passes them to the dashboard view.
     */
    public function index()
    {
        // ✅ Retrieve total counts for dashboard statistics
        $courses_count = Course::count();        // Total number of courses
        $instructors_count = Instructor::count(); // Total number of instructors
        $students_count = Student::count();       // Total number of students
        $plans_count = Plan::count();             // Total number of academic plans

        // ✅ Count the number of admins based on their role (RoleID = 1)
        $admins_count = Instructor::where('RoleID', 1)->count(); 

        // ✅ Retrieve all courses (if needed for listing on the dashboard)
        $courses = Course::all();

        // ✅ Pass all required data to the admin dashboard view
        return view('admin.dashboard', compact(
            'courses_count', 
            'instructors_count', 
            'students_count', 
            'admins_count', 
            'plans_count',
            'courses'
        ));
    }
}

