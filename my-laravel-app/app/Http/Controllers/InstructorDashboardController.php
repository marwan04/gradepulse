<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
use App\Models\Enrollment;
use App\Models\Student;

class InstructorDashboardController extends Controller
{
    /**
     * ✅ Display the Instructor Dashboard.
     * - Fetches the logged-in instructor's sections.
     * - Retrieves students enrolled in those sections.
     * - Passes data to the instructor dashboard view.
     */
    public function index()
    {
        // ✅ Get the logged-in instructor
        $instructor = Auth::guard('instructor')->user();

        // ✅ Fetch sections that belong to this instructor
        $sections = Section::where('InstructorID', $instructor->InstructorID)->get();

        // ✅ Fetch enrolled students in the instructor's sections
        $enrollments = Enrollment::whereIn('SectionID', $sections->pluck('SectionID'))
            ->join('Student', 'Enrollment.StudentID', '=', 'Student.StudentID') // ✅ Ensure correct table name
            ->select('Enrollment.*', 'Student.name as StudentName') // ✅ Select student name for display
            ->get();

        // ✅ Pass data to the instructor dashboard view
        return view('instructor.dashboard', compact('sections', 'enrollments'));
    }
}

