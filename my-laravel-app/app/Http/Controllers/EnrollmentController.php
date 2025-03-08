<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Section;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'section'])->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::all();
        $sections = Section::all();
        return view('admin.enrollments.create', compact('students', 'sections'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'StudentID'   => 'required|exists:Student,StudentID',
            'SectionID'   => 'required|exists:Section,SectionID',
            'NumericMark' => 'nullable|numeric|min:0|max:100',
            'AlphaMark'   => 'nullable|string|max:10',
            'Completed'   => 'boolean'
        ]);

        Enrollment::create($validatedData);

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment added successfully!');
    }

    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Student::all();
        $sections = Section::all();
        return view('admin.enrollments.edit', compact('enrollment', 'students', 'sections'));
    }

public function update(Request $request, $id)
{
    // ✅ Find the existing enrollment record
    $enrollment = Enrollment::findOrFail($id);

    // ✅ Validate the request data
    $validatedData = $request->validate([
        'NumericMark' => 'nullable|numeric|min:0|max:100',
        'AlphaMark' => 'nullable|string|max:10',
        'Completed' => 'required|boolean',
        'StudentID' => 'required|exists:Student,StudentID',
        'SectionID' => 'required|exists:Section,SectionID',
    ]);

    // ✅ Debugging - Log received data
    \Log::info('Updating Enrollment:', $validatedData);

    // ✅ Update the enrollment record
    $enrollment->update([
        'NumericMark' => $validatedData['NumericMark'],
        'AlphaMark' => $validatedData['AlphaMark'],
        'Completed' => $validatedData['Completed'],
        'StudentID' => $validatedData['StudentID'],
        'SectionID' => $validatedData['SectionID'],
    ]);

    // ✅ Redirect back with success message
    return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment updated successfully.');
}

    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment deleted successfully!');
    }
}

