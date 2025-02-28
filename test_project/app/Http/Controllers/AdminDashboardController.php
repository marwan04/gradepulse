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
        $courses_count = Course::count();
        $instructors_count = Instructor::count();
        $students_count = Student::count();

        return view('admin.dashboard', compact('courses_count', 'instructors_count', 'students_count'));
    }
}

