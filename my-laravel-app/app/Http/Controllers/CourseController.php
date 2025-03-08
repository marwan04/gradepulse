<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Plan;

class CourseController extends Controller
{
    /**
     * عرض جميع الكورسات.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * إظهار نموذج إضافة كورس جديد.
     */
    public function create()
    {
	    $plans = Plan::all(); // Fetch all available plans
    return view('admin.courses.create', compact('plans'));
    }

    /**
     * حفظ الكورس الجديد.
     */
public function store(Request $request)
{
    $validatedData = $request->validate([
        'CourseID'   => 'required|integer|unique:Course,CourseID', // Ensure the CourseID is unique
        'CourseName' => 'required|string|max:255',
        'Credits'    => 'required|integer|min:1',
        'plans'      => 'required|array',
        'plans.*'    => 'exists:Plan,PlanID',
    ]);

    // ✅ 1. Manually insert CourseID first
    $course = new Course();
    $course->CourseID = $validatedData['CourseID']; // Ensuring manual CourseID is stored
    $course->CourseName = $validatedData['CourseName'];
    $course->Credits = $validatedData['Credits'];
    $course->save(); // ✅ Save course first before adding PlanCourse relations

    // ✅ 2. Ensure CourseID exists before inserting into PlanCourse
    foreach ($validatedData['plans'] as $planID) {
        \DB::table('PlanCourse')->insert([
            'CourseID' => $validatedData['CourseID'], // Now CourseID exists
            'PlanID'   => $planID,
        ]);
    }

    return redirect()->route('admin.courses.index')->with('success', 'Course added successfully!');
}

    /**
     * إظهار نموذج تعديل كورس معين.
     */

public function edit($id)
{
    $course = Course::findOrFail($id); // Fetch the course
    $plans = Plan::all(); // Fetch all plans
    $selectedPlans = DB::table('PlanCourse')->where('CourseID', $id)->pluck('PlanID')->toArray(); // Get assigned plans

    return view('admin.courses.edit', compact('course', 'plans', 'selectedPlans'));
}


    /**
     * تحديث بيانات الكورس.
     */
public function update(Request $request, $CourseID)
{
    $validatedData = $request->validate([
        'CourseID'   => 'required|numeric',
        'CourseName' => 'required|string|max:255',
        'Credits'    => 'required|numeric|min:1',
        'plans'      => 'array|required',
        'plans.*'    => 'exists:Plan,PlanID'
    ]);

    // Find the course by ID
    $course = Course::findOrFail($CourseID);

    // ✅ Update the Course Info
    $course->update([
        'CourseID'   => $validatedData['CourseID'],
        'CourseName' => $validatedData['CourseName'],
        'Credits'    => $validatedData['Credits'],
    ]);

    // ✅ Sync Plans (This will remove any unselected plans)
    \DB::table('PlanCourse')
        ->where('CourseID', $CourseID)
        ->delete(); // Remove all existing associations

    // ✅ Re-insert selected plans
    foreach ($validatedData['plans'] as $planID) {
        \DB::table('PlanCourse')->insert([
            'CourseID' => $CourseID,
            'PlanID'   => $planID,
        ]);
    }

    return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
}

    /**
     * حذف كورس معين.
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return abort(404);
        }
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'تم حذف الكورس بنجاح!');
    }
}

