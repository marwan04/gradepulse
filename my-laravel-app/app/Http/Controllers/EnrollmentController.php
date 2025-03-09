<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Section;

class EnrollmentController extends Controller
{
    /**
     * ✅ Display all enrollments (Admin View).
     * Retrieves all enrollments along with their associated students and sections.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'section'])->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * ✅ Show the form to create a new enrollment.
     * Retrieves all students and sections for selection.
     */
    public function create()
    {
        $students = Student::all();
        $sections = Section::all();
        return view('admin.enrollments.create', compact('students', 'sections'));
    }

    /**
     * ✅ Store a new enrollment in the database.
     * Validates input, ensures relationships exist, and creates the record.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'StudentID'   => 'required|exists:Student,StudentID', // Ensure Student exists
            'SectionID'   => 'required|exists:Section,SectionID', // Ensure Section exists
            'NumericMark' => 'nullable|numeric|min:0|max:100',    // Grade range validation
            'AlphaMark'   => 'nullable|string|max:10',           // Grade format validation
            'Completed'   => 'boolean'                           // Must be true or false
        ]);

        Enrollment::create($validatedData);

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment added successfully!');
    }

    /**
     * ✅ Show the form to edit an existing enrollment.
     * Retrieves the enrollment details, students, and sections.
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Student::all();
        $sections = Section::all();
        return view('admin.enrollments.edit', compact('enrollment', 'students', 'sections'));
    }

    /**
     * ✅ Update an existing enrollment in the database.
     * Validates input, ensures relationships exist, and updates the record.
     */
    public function update(Request $request, $id)
    {
        // ✅ Find the existing enrollment record
        $enrollment = Enrollment::findOrFail($id);

        // ✅ Validate the request data
        $validatedData = $request->validate([
            'NumericMark' => 'nullable|numeric|min:0|max:100',  // Grade validation
            'AlphaMark'   => 'nullable|string|max:10',         // Grade format validation
            'Completed'   => 'required|boolean',               // Boolean check
            'StudentID'   => 'required|exists:Student,StudentID', // Ensure Student exists
            'SectionID'   => 'required|exists:Section,SectionID', // Ensure Section exists
        ]);

        // ✅ Debugging - Log received data
        \Log::info('Updating Enrollment:', $validatedData);

        // ✅ Update the enrollment record
        $enrollment->update([
            'NumericMark' => $validatedData['NumericMark'],
            'AlphaMark'   => $validatedData['AlphaMark'],
            'Completed'   => $validatedData['Completed'],
            'StudentID'   => $validatedData['StudentID'],
            'SectionID'   => $validatedData['SectionID'],
        ]);

        // ✅ Redirect back with success message
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    /**
     * ✅ Delete an enrollment from the database.
     * Ensures the record exists before deletion.
     */
    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment deleted successfully!');
    }
}

