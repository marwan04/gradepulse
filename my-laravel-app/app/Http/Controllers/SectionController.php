<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    /**
     * ✅ Display a list of all sections.
     * - Retrieves sections with related course and instructor data.
     */
    public function index()
    {
        $sections = Section::with(['course', 'instructor'])->get();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * ✅ Show the form for creating a new section.
     * - Retrieves available courses and instructors.
     */
    public function create()
    {
        $courses = Course::all(); 
        $instructors = Instructor::all(); 

        return view('admin.sections.create', compact('courses', 'instructors'));
    }

    /**
     * ✅ Store a newly created section in the database.
     * - Validates input before inserting the record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester'      => 'required|string|max:20',
            'year'          => 'required|integer|min:2020',
            'course_id'     => 'required|exists:Course,CourseID', // Ensure Course exists
            'instructor_id' => 'required|exists:Instructor,InstructorID', // Ensure Instructor exists
        ]);

        Section::create([
            'Semester'     => $request->input('semester'),
            'Year'         => $request->input('year'),
            'CourseID'     => $request->input('course_id'),
            'InstructorID' => $request->input('instructor_id'),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully!');
    }

    /**
     * ✅ Show the form for editing a specific section.
     * - Ensures the requested section exists before displaying the form.
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id); // ✅ Fetch section from database
        $courses = Course::all();
        $instructors = Instructor::all();
        
        return view('admin.sections.edit', compact('section', 'courses', 'instructors'));
    }

    /**
     * ✅ Update an existing section in the database.
     * - Validates input and updates the section details.
     */
    public function update(Request $request, $id)
    {
        Log::info("📌 Updating section: ID => " . $id);
        Log::info("📌 Form data received: ", $request->all());

        try {
            $validatedData = $request->validate([
                'semester'      => 'required|string|max:20',
                'year'          => 'required|integer|min:2020',
                'course_id'     => 'required|exists:Course,CourseID', // Ensure Course exists
                'instructor_id' => 'required|exists:Instructor,InstructorID', // Ensure Instructor exists
            ]);

            Log::info("✅ Validation successful!", $validatedData);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("❌ Validation failed!", $e->errors());
            return redirect()->back()->withErrors($e->errors());
        }

        $section = Section::findOrFail($id);
        Log::info("✅ Section before update: ", $section->toArray());

        // ✅ Update section details
        $section->update([
            'Semester'     => $request->input('semester'),
            'Year'         => $request->input('year'),
            'CourseID'     => $request->input('course_id'),
            'InstructorID' => $request->input('instructor_id'),
        ]);

        Log::info("✅ Section after update: ", $section->toArray());

        return redirect()->route('admin.sections.index')->with('success', 'Section updated successfully!');
    }

    /**
     * ✅ Delete a section from the database.
     * - Ensures the section is deleted and redirects with a success message.
     */

    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);

            $section->delete(); // Attempt to delete

            return redirect()->route('admin.sections.index')->with('success', 'Section deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('admin.sections.index')->with('error', 'Cannot delete this section because it is associated with enrollments.');
            }
            return redirect()->route('admin.sections.index')->with('error', 'An unexpected error occurred while deleting the section.');
        }
    }

}

