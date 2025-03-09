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
    /**
     * ✅ Display the student dashboard.
     * - Fetches total courses enrolled, student progress, GPA, completed assignments, and available semesters.
     */
    public function index()
    {
        $studentId = Auth::id(); // ✅ Get the logged-in student's ID

        // ✅ Fetch total number of unique courses the student is enrolled in
        $totalCourses = Enrollment::where('StudentID', $studentId)->distinct('SectionID')->count();

        // ✅ Fetch student progress (GPA and completed assignments)
        $studentProgress = StudentProgress::where('StudentID', $studentId)->first();
        $gpa = $studentProgress->GPA ?? 'N/A'; // ✅ Default to 'N/A' if GPA is missing
        $completedAssignments = $studentProgress->CompletedAssignments ?? 0; // ✅ Default to 0 if no data

        // ✅ Get DISTINCT semesters from the Section table (only those the student is enrolled in)
        $semesters = Section::whereHas('enrollments', function ($query) use ($studentId) {
            $query->where('StudentID', $studentId);
        })->pluck('Semester')->unique();

        // ✅ Fetch courses the student is enrolled in
        $courses = Course::whereHas('sections.enrollments', function ($query) use ($studentId) {
            $query->where('StudentID', $studentId);
        })->get();

        // ✅ Pass all retrieved data to the student dashboard view
        return view('student.dashboard', compact('totalCourses', 'completedAssignments', 'gpa', 'semesters', 'courses'));
    }
}

