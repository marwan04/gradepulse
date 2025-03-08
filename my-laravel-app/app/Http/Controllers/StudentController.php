<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Plan;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = Student::all(); // Fetch all students
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
	$plans = Plan::all(); // Fetch all plans from the database
    	return view('admin.students.create', compact('plans'));
    }
    /**
     * Store a newly created student.
     */
public function store(Request $request)
{
    $request->validate([
        'StudentID' => 'required|numeric|unique:Student,StudentID',
        'Name' => 'required|string|max:255',
        'Email' => [
            'required',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@studentdomain\.com$/',
            'unique:Student,Email'
        ],
        'PlanID' => 'nullable|numeric|exists:Plan,PlanID',
        'Password' => 'required|string|min:8'
    ]);

    // ✅ Using Eloquent save() to manually assign fields
    $student = new Student();
    $student->StudentID = $request->StudentID;
    $student->Name = $request->Name;
    $student->Email = $request->Email;
    $student->PlanID = $request->PlanID; // ✅ Correct field name
    $student->Password = bcrypt($request->Password); // ✅ Encrypt password
    $student->save(); // ✅ Save student

    return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');
}

    /**
     * Show the form for editing a student.
     */
    public function edit($id)
    {
	$student = Student::findOrFail($id); // Fetch student by ID
	$plans = Plan::all(); // Fetch all available plans

	return view('admin.students.edit', compact('student', 'plans'));
    }

    /**
     * Update the student record.
     */
public function update(Request $request, $id)
{
    $request->validate([
        'Name' => 'required|string|max:255', // ✅ Ensure Name is required
        'Email' => [
            'required',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@studentdomain\.com$/',
            'unique:Student,Email,' . $id . ',StudentID' // ✅ Ignore the current student's email
        ],
        'PlanID' => 'nullable|numeric|exists:Plan,PlanID',
        'Password' => 'nullable|string|min:8' // ✅ Password is optional
    ]);

    // ✅ Find student by ID
    $student = Student::findOrFail($id);
    
    // ✅ Update fields
    $student->Name = $request->Name;
    $student->Email = $request->Email;
    $student->PlanID = $request->PlanID;

    // ✅ Update password only if provided
    if (!empty($request->Password)) {
        $student->Password = bcrypt($request->Password);
    }

    $student->save(); // ✅ Save updated student

    return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
}

    /**
     * Remove the student record.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}

