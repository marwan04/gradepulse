<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\StudentProgress;
use App\Models\Course;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $studentId = Auth::id(); // Get the logged-in student's ID

        // ✅ Fetch total courses
        $totalCourses = Enrollment::where('StudentID', $studentId)->distinct('SectionID')->count();

        // ✅ Fetch student progress (GPA, assignments completed)
        $studentProgress = StudentProgress::where('StudentID', $studentId)->first();
        $gpa = $studentProgress->GPA ?? 'N/A';
        $completedAssignments = $studentProgress->CompletedAssignments ?? 0;

        // ✅ Get list of DISTINCT semesters from the Section table (only those the student is enrolled in)
        $semesters = Section::whereHas('enrollments', function ($query) use ($studentId) {
            $query->where('StudentID', $studentId);
        })->pluck('Semester')->unique();

        // ✅ Fetch student courses dynamically
        $courses = Course::whereHas('sections.enrollments', function ($query) use ($studentId) {
            $query->where('StudentID', $studentId);
        })->get();

        return view('student.dashboard', compact('totalCourses', 'completedAssignments', 'gpa', 'semesters', 'courses'));
    }
}

