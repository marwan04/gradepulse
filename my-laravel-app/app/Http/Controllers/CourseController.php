<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Plan;

class CourseController extends Controller
{
    /**
     * ✅ Display a list of all courses (Admin View).
     * Retrieves all courses from the database and passes them to the view.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * ✅ Show the form to create a new course.
     * Retrieves all available academic plans for course association.
     */
    public function create()
    {
        $plans = Plan::all(); // Fetch all available plans
        return view('admin.courses.create', compact('plans'));
    }

    /**
     * ✅ Store a new course in the database.
     * Validates input data, creates the course, and associates it with selected plans.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'CourseID'   => 'required|integer|unique:Course,CourseID', // Ensure CourseID is unique
            'CourseName' => 'required|string|max:255',
            'Credits'    => 'required|integer|min:1',
            'plans'      => 'required|array',
            'plans.*'    => 'exists:Plan,PlanID', // Ensure each selected PlanID exists
        ]);

        // ✅ Step 1: Create the Course Record
        $course = new Course();
        $course->CourseID = $validatedData['CourseID']; // Manually setting CourseID
        $course->CourseName = $validatedData['CourseName'];
        $course->Credits = $validatedData['Credits'];
        $course->save(); // Save course before inserting relationships

        // ✅ Step 2: Associate Course with Selected Plans
        foreach ($validatedData['plans'] as $planID) {
            DB::table('PlanCourse')->insert([
                'CourseID' => $validatedData['CourseID'], // Now CourseID exists
                'PlanID'   => $planID,
            ]);
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully!');
    }

    /**
     * ✅ Show the form to edit an existing course.
     * Retrieves course details along with associated plans.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id); // Fetch the course by ID
        $plans = Plan::all(); // Fetch all available plans
        $selectedPlans = DB::table('PlanCourse')->where('CourseID', $id)->pluck('PlanID')->toArray(); // Get selected plans

        return view('admin.courses.edit', compact('course', 'plans', 'selectedPlans'));
    }

    /**
     * ✅ Update an existing course in the database.
     * Updates course details and syncs the associated plans.
     */
    public function update(Request $request, $CourseID)
    {
        $validatedData = $request->validate([
            'CourseID'   => 'required|numeric',
            'CourseName' => 'required|string|max:255',
            'Credits'    => 'required|numeric|min:1',
            'plans'      => 'required|array',
            'plans.*'    => 'exists:Plan,PlanID' // Ensure valid PlanIDs
        ]);

        // ✅ Step 1: Find and Update Course Details
        $course = Course::findOrFail($CourseID);
        $course->update([
            'CourseID'   => $validatedData['CourseID'],
            'CourseName' => $validatedData['CourseName'],
            'Credits'    => $validatedData['Credits'],
        ]);

        // ✅ Step 2: Sync Course Plans (Remove unselected plans)
        DB::table('PlanCourse')->where('CourseID', $CourseID)->delete(); // Remove all existing associations

        // ✅ Step 3: Reinsert Selected Plans
        foreach ($validatedData['plans'] as $planID) {
            DB::table('PlanCourse')->insert([
                'CourseID' => $CourseID,
                'PlanID'   => $planID,
            ]);
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * ✅ Delete a specific course from the database.
     * Checks if the course exists, deletes it, and redirects with a success message.
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return abort(404); // Return 404 if course does not exist
        }

        try {
            $course->delete(); // Attempt to delete the course
            return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            // 🛑 Foreign key violation detected (course is used in another table)
            return redirect()->route('admin.courses.index')->with('error', 'Cannot delete this course as it is linked to other records.');
        }
    }

}

