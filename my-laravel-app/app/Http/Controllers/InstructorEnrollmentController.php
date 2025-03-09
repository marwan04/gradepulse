<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Section;
use App\Models\Course;

class InstructorEnrollmentController extends Controller
{
    /**
     * ✅ Display all students enrolled in the instructor's sections.
     */
    public function index()
    {
        $instructorId = Auth::guard('instructor')->user()->InstructorID;

        // ✅ Fetch sections the instructor teaches
        $sections = Section::where('InstructorID', $instructorId)->pluck('SectionID');

        // ✅ Fetch enrolled students with course names
        $enrollments = Enrollment::whereIn('Enrollment.SectionID', $sections)
            ->join('Student', 'Enrollment.StudentID', '=', 'Student.StudentID')
            ->join('Section', 'Enrollment.SectionID', '=', 'Section.SectionID')
            ->join('Course', 'Section.CourseID', '=', 'Course.CourseID') // Join with Course to get course name
            ->select(
                'Enrollment.*',
                'Student.name as StudentName',
                'Course.CourseName as CourseName' // Fetch course name
            )
            ->get();

        Log::info("✅ Fetched enrollments: ", $enrollments->toArray());

        return view('instructor.enrollments.index', compact('enrollments'));
    }

    /**
     * ✅ Show the form for editing a specific enrollment.
     */
    public function edit($id)
    {
        $instructorId = Auth::guard('instructor')->user()->InstructorID;

        // ✅ Fetch the enrollment and ensure the instructor owns the section
        $enrollment = Enrollment::join('Section', 'Enrollment.SectionID', '=', 'Section.SectionID')
            ->join('Course', 'Section.CourseID', '=', 'Course.CourseID')
            ->where('Enrollment.EnrollmentID', $id)
            ->where('Section.InstructorID', $instructorId)
            ->select('Enrollment.*', 'Course.CourseName')
            ->first();

        // ✅ If the enrollment is not found or unauthorized access, redirect
        if (!$enrollment) {
            return redirect()->route('instructor.dashboard')->with('error', 'Unauthorized access.');
        }

        return view('instructor.enrollments.edit', compact('enrollment'));
    }

    /**
     * ✅ Update the specified enrollment in storage.
     */
    public function update(Request $request, $id)
    {
        $instructorId = Auth::guard('instructor')->user()->InstructorID;

        // ✅ Validate the request
        $request->validate([
            'NumericMark' => 'required|numeric|min:0|max:100', // Ensure numeric mark is between 0-100
        ]);

        // ✅ Fetch the enrollment and ensure the instructor owns the section
        $enrollment = Enrollment::join('Section', 'Enrollment.SectionID', '=', 'Section.SectionID')
            ->where('Enrollment.EnrollmentID', $id)
            ->where('Section.InstructorID', $instructorId)
            ->select('Enrollment.*')
            ->first();

        // ✅ If unauthorized, redirect with an error message
        if (!$enrollment) {
            return redirect()->route('instructor.dashboard')->with('error', 'Unauthorized access.');
        }

        // ✅ Update the numeric mark and calculate the alpha mark
        $enrollment->NumericMark = $request->input('NumericMark');
        $enrollment->AlphaMark = $this->calculateAlphaMark($enrollment->NumericMark);
        $enrollment->save();

        return redirect()->route('instructor.enrollments.index')
            ->with('success', 'Student mark updated successfully.');
    }

    /**
     * ✅ Convert numeric mark to alpha grade.
     * - Uses standard grading scale to determine letter grade.
     */
    private function calculateAlphaMark($numericMark)
    {
        if ($numericMark >= 95) return 'A';
        if ($numericMark >= 90) return 'A-';
        if ($numericMark >= 85) return 'B+';
        if ($numericMark >= 80) return 'B';
        if ($numericMark >= 75) return 'C+';
        if ($numericMark >= 70) return 'C';
        if ($numericMark >= 65) return 'D+';
        if ($numericMark >= 60) return 'D';
        return 'F';
    }
}

