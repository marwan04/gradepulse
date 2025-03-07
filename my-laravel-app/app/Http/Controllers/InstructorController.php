<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use App\Models\Enrollment;
use App\Models\Plan;
use App\Models\Role;
use App\Models\StudentProgress;
use App\Models\Team;
use App\Models\Instructor;  // <-- New Import
use App\Imports\EnrollmentImport;
use Maatwebsite\Excel\Facades\Excel;     

class InstructorController extends Controller
{
    /**
     * Show the Instructor Dashboard.
     */
    public function dashboard()
    {
        return view('instructor.dashboard');
    }

    // ======================= INSTRUCTOR MANAGEMENT (NEW) =======================

    /**
     * Show all instructors.
     */
    public function index()
    {
	$instructors = \App\Models\Instructor::all();;
        return view('admin.instructors.index', compact('instructors'));
    }

    /**
     * Show the form to create a new instructor.
     */
    public function create()
{
    $roles = \App\Models\Role::all(); // Fetch all roles

    return view('admin.instructors.create', compact('roles')); // Pass roles to view
}


    /**
     * Store a new instructor in the database.
     */

public function store(Request $request)
{
    try {
        \DB::beginTransaction(); // Start transaction

        // Validate input
        $validatedData = $request->validate([
            'InstructorID' => 'required|numeric|unique:Instructor,InstructorID',
            'Name' => 'required|string|max:255',
            'Email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@instructordomain\.com$/', 'unique:Instructor,Email'],
            'Phone' => 'nullable|string|max:20',
            'RoleID' => 'required|numeric',
            'Password' => 'required|string|min:8'
        ]);

        // Enable manual ID insertion
        \DB::statement('SET SESSION sql_mode = ""'); // Disable strict mode for this session

        // Manually insert using SQL
        $query = "INSERT INTO Instructor (InstructorID, Name, Email, Phone, RoleID, Password) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        $values = [
            $validatedData['InstructorID'],
            $validatedData['Name'],
            $validatedData['Email'],
            $validatedData['Phone'],
            $validatedData['RoleID'],
            bcrypt('Default123!')
        ];

        $result = \DB::insert($query, $values);

        if ($result) {
            \DB::commit(); // Commit the transaction
            return redirect()->route('admin.instructors.index')->with('success', 'Instructor added successfully.');
        } else {
            \DB::rollBack(); // Rollback if failed
            return redirect()->back()->with('error', 'Failed to add instructor.');
        }

    } catch (\Exception $e) {
        \DB::rollBack(); // Rollback on error
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}


    /**
     * Show the form to edit an existing instructor.
     */
    public function edit($id)
    {
	    $instructor = \App\Models\Instructor::findOrFail($id); // Fetch instructor
    	    $roles = \App\Models\Role::all(); // Fetch all roles

   	    return view('admin.instructors.edit', compact('instructor', 'roles'));
    }

    /**
     * Update an existing instructor.
     */
public function update(Request $request, $id)
{
    try {
        \DB::beginTransaction(); // Start transaction

        // Validate input
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@instructordomain\.com$/', 'unique:Instructor,Email,' . $id . ',InstructorID'],
            'Phone' => 'nullable|string|max:20',
            'RoleID' => 'required|numeric'
        ]);

        // Fetch instructor
        $instructor = \App\Models\Instructor::findOrFail($id);

        // Update fields
        $instructor->Name = $validatedData['Name'];
        $instructor->Email = $validatedData['Email'];
        $instructor->Phone = $validatedData['Phone'];
        $instructor->RoleID = $validatedData['RoleID'];

        $instructor->save(); // Save the changes

        \DB::commit(); // Commit transaction
        return redirect()->route('admin.instructors.index')->with('success', 'Instructor updated successfully.');

    } catch (\Exception $e) {
        \DB::rollBack(); // Rollback on error
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}

    /**
     * Delete an instructor record.
     */
    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return redirect()->route('admin.instructors.index')->with('success', 'Instructor removed successfully.');
    }

    // ======================= COURSE MANAGEMENT =======================

    /**
     * Show all courses.
     */
    public function courses()
    {
        $courses = Course::all();
        return view('instructor.courses', compact('courses'));
    }

    /**
     * Store a new course.
     */
    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('instructor.courses')->with('success', 'Course added successfully.');
    } 

    // ======================= EXCEL UPLOAD =======================
    
    /**
     * Upload Excel file and import enrollments.
     */
    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new EnrollmentImport, $request->file('file'));

        return redirect()->back()->with('success', 'تم رفع العلامات بنجاح!');
    }

    // (EXISTING LOGIC UNCHANGED)
}

