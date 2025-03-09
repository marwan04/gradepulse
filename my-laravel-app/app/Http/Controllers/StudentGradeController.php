<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // ✅ Import DB for querying views
use App\Models\Enrollment;
use App\Models\Section;

class StudentGradeController extends Controller
{
    /**
     * Display cumulative grades across all semesters.
     */
    public function index()
    {
        $studentId = Auth::id(); // Get the logged-in student's ID

        // ✅ Fetch all grades for the student across all semesters
        $grades = Enrollment::with(['section.course'])
            ->where('StudentID', $studentId)
            ->get()
            ->sortBy('section.Semester'); // ✅ Order after fetching, since Semester is inside Section

        // ✅ Get list of distinct semesters from Section (since we don't have a Semester table)
        $semesters = Section::whereHas('enrollments', function ($query) use ($studentId) {
            $query->where('StudentID', $studentId);
        })->pluck('Semester')->unique();

        // ✅ Fetch student progress from the `StudentProgress` **view** using DB::table()
        $studentProgress = DB::table('StudentProgress')->where('StudentID', $studentId)->first();

        return view('student.grades.index', compact('grades', 'semesters', 'studentProgress'));
    }
public function showSemester($semester)
{
    $studentId = Auth::id();

    // ✅ Fetch grades only for the selected semester
    $semesterGrades = Enrollment::whereHas('section', function ($query) use ($semester) {
        $query->where('Semester', $semester);
    })
    ->where('StudentID', $studentId)
    ->with(['section.course'])
    ->get();

    return view('student.grades.semester', compact('semesterGrades', 'semester'));
}

}

