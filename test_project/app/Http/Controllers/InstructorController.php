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

class InstructorController extends Controller
{
    /**
     * Show the Instructor Dashboard.
     */
    public function dashboard()
    {
        return view('instructor.dashboard');
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

    /**
     * Update a course.
     */
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->route('instructor.courses')->with('success', 'Course updated successfully.');
    }

    /**
     * Delete a course.
     */
    public function deleteCourse($id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->route('instructor.courses')->with('success', 'Course deleted successfully.');
    }

    // ======================= SECTION MANAGEMENT =======================

    public function sections()
    {
        $sections = Section::all();
        return view('instructor.sections', compact('sections'));
    }

    public function storeSection(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Section::create([
            'name' => $request->name,
        ]);

        return redirect()->route('instructor.sections')->with('success', 'Section added successfully.');
    }

    public function updateSection(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->update($request->all());

        return redirect()->route('instructor.sections')->with('success', 'Section updated successfully.');
    }

    public function deleteSection($id)
    {
        Section::findOrFail($id)->delete();
        return redirect()->route('instructor.sections')->with('success', 'Section deleted successfully.');
    }

    // ======================= ENROLLMENT MANAGEMENT =======================

    public function enrollments()
    {
        $enrollments = Enrollment::all();
        return view('instructor.enrollments', compact('enrollments'));
    }

    public function storeEnrollment(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        Enrollment::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('instructor.enrollments')->with('success', 'Enrollment added successfully.');
    }

    public function updateEnrollment(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());

        return redirect()->route('instructor.enrollments')->with('success', 'Enrollment updated successfully.');
    }

    public function deleteEnrollment($id)
    {
        Enrollment::findOrFail($id)->delete();
        return redirect()->route('instructor.enrollments')->with('success', 'Enrollment deleted successfully.');
    }

    // ======================= PLAN MANAGEMENT =======================

    public function plans()
    {
        $plans = Plan::all();
        return view('instructor.plans', compact('plans'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Plan::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('instructor.plans')->with('success', 'Plan added successfully.');
    }

    public function updatePlan(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->all());

        return redirect()->route('instructor.plans')->with('success', 'Plan updated successfully.');
    }

    public function deletePlan($id)
    {
        Plan::findOrFail($id)->delete();
        return redirect()->route('instructor.plans')->with('success', 'Plan deleted successfully.');
    }

    // ======================= ROLE MANAGEMENT =======================

    public function roles()
    {
        $roles = Role::all();
        return view('instructor.roles', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('instructor.roles')->with('success', 'Role added successfully.');
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect()->route('instructor.roles')->with('success', 'Role updated successfully.');
    }

    public function deleteRole($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('instructor.roles')->with('success', 'Role deleted successfully.');
    }

    // ======================= STUDENT PROGRESS MANAGEMENT =======================

    public function progress()
    {
        $progress = StudentProgress::all();
        return view('instructor.progress', compact('progress'));
    }

    public function storeProgress(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'progress' => 'required|numeric|min:0|max:100',
        ]);

        StudentProgress::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'progress' => $request->progress,
        ]);

        return redirect()->route('instructor.progress')->with('success', 'Student progress updated successfully.');
    }

    public function updateProgress(Request $request, $id)
    {
        $progress = StudentProgress::findOrFail($id);
        $progress->update($request->all());

        return redirect()->route('instructor.progress')->with('success', 'Student progress updated successfully.');
    }

    public function deleteProgress($id)
    {
        StudentProgress::findOrFail($id)->delete();
        return redirect()->route('instructor.progress')->with('success', 'Student progress deleted successfully.');
    }

    // ======================= TEAM MANAGEMENT =======================

    public function teams()
    {
        $teams = Team::all();
        return view('instructor.teams', compact('teams'));
    }

    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Team::create([
            'name' => $request->name,
        ]);

        return redirect()->route('instructor.teams')->with('success', 'Team added successfully.');
    }

    public function updateTeam(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->update($request->all());

        return redirect()->route('instructor.teams')->with('success', 'Team updated successfully.');
    }

    public function deleteTeam($id)
    {
        Team::findOrFail($id)->delete();
        return redirect()->route('instructor.teams')->with('success', 'Team deleted successfully.');
    }
}
