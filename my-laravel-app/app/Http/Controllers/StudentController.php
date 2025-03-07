<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Role;

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
        $roles = Role::all(); // Fetch all roles
        return view('admin.students.create', compact('roles'));
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction(); // Start transaction

            // Validate input
            $validatedData = $request->validate([
                'StudentID' => 'required|numeric|unique:Student,StudentID',
                'Name' => 'required|string|max:255',
                'Email' => ['required', 'email', 'unique:Student,Email'],
                'Phone' => 'nullable|string|max:20',
                'RoleID' => 'required|numeric',
                'Password' => 'required|string|min:8'
            ]);

            // Insert new student
            $student = new Student();
            $student->StudentID = $validatedData['StudentID'];
            $student->Name = $validatedData['Name'];
            $student->Email = $validatedData['Email'];
            $student->Phone = $validatedData['Phone'];
            $student->RoleID = $validatedData['RoleID'];
            $student->Password = bcrypt($validatedData['Password']); // Hash password
            $student->save();

            \DB::commit(); // Commit transaction
            return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');

        } catch (\Exception $e) {
            \DB::rollBack(); // Rollback on error
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing a student.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id); // Fetch student data
        $roles = Role::all(); // Fetch all roles
        return view('admin.students.edit', compact('student', 'roles'));
    }

    /**
     * Update the student record.
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction(); // Start transaction

            // Validate input
            $validatedData = $request->validate([
                'Name' => 'required|string|max:255',
                'Email' => ['required', 'email', 'unique:Student,Email,' . $id . ',StudentID'],
                'Phone' => 'nullable|string|max:20',
                'RoleID' => 'required|numeric'
            ]);

            // Update student data
            $student = Student::findOrFail($id);
            $student->Name = $validatedData['Name'];
            $student->Email = $validatedData['Email'];
            $student->Phone = $validatedData['Phone'];
            $student->RoleID = $validatedData['RoleID'];
            $student->save();

            \DB::commit(); // Commit transaction
            return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');

        } catch (\Exception $e) {
            \DB::rollBack(); // Rollback on error
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
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

