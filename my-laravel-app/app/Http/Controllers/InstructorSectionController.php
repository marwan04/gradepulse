<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
use App\Models\Course;

class InstructorSectionController extends Controller
{
    /**
     * Display a listing of the instructor's sections.
     */
    public function index()
    {
        $instructorID = Auth::guard('instructor')->user()->InstructorID;
        
        // Get only sections belonging to the logged-in instructor
        $sections = Section::where('InstructorID', $instructorID)->get();

        return view('instructor.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new section.
     */
    public function create()
    {
        $instructorID = Auth::guard('instructor')->user()->InstructorID;
        $courses = Course::all(); // Fetch all courses from the database

        // Define available semesters
        $semesters = ['Fall', 'Spring', 'Summer'];

        return view('instructor.sections.create', compact('courses', 'semesters'));
    }

    /**
     * Store a newly created section in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Semester' => 'required|string|max:255',
            'Year' => 'required|integer',
            'CourseID' => 'required|integer|exists:Course,CourseID',
        ]);

        Section::create([
            'Semester' => $request->Semester,
            'Year' => $request->Year,
            'CourseID' => $request->CourseID,
            'InstructorID' => Auth::guard('instructor')->user()->InstructorID, // Assign the instructor automatically
        ]);

        return redirect()->route('instructor.sections.index')->with('success', 'Section created successfully!');
    }

    /**
     * Show the form for editing a section (only if it belongs to the instructor).
     */
    public function edit($id)
    {
        $instructorID = Auth::guard('instructor')->user()->InstructorID;

        // Ensure the section belongs to the instructor
        $section = Section::where('SectionID', $id)
                          ->where('InstructorID', $instructorID)
                          ->firstOrFail();

        $courses = Course::all(); // Fetch all courses from the database
        $semesters = ['Fall', 'Spring', 'Summer']; // Available semesters

        return view('instructor.sections.edit', compact('section', 'courses', 'semesters'));
    }

    /**
     * Update the section in the database (only if it belongs to the instructor).
     */
    public function update(Request $request, $id)
    {
        $instructorID = Auth::guard('instructor')->user()->InstructorID;

        // Ensure the section belongs to the instructor
        $section = Section::where('SectionID', $id)
                          ->where('InstructorID', $instructorID)
                          ->firstOrFail();

        $request->validate([
            'Semester' => 'required|string|max:255',
            'Year' => 'required|integer',
            'CourseID' => 'required|integer|exists:Course,CourseID',
        ]);

        $section->update([
            'Semester' => $request->Semester,
            'Year' => $request->Year,
            'CourseID' => $request->CourseID,
        ]);

        return redirect()->route('instructor.sections.index')->with('success', 'Section updated successfully!');
    }
}
