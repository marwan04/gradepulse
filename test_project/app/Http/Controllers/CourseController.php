<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::all();
        return view('instructor.courses.index', compact('courses'));  
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('instructor.courses.create');
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $request->validate([
            'CourseName' => 'required|string|max:255',
            'Credits' => 'required|integer|min:1',
        ]);

        Course::create([
            'CourseName' => $request->CourseName,
            'Credits' => $request->Credits,
        ]);

        return redirect()->route('instructor.courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Show the form for editing a course.
     */
    public function edit(Course $course) // ✅ Dependency Injection
    {
        return view('instructor.courses.edit', compact('course'));
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, Course $course) // ✅ Dependency Injection
    {
        $request->validate([
            'CourseName' => 'required|string|max:255',
            'Credits' => 'required|integer|min:1',
        ]);

        $course->update([
            'CourseName' => $request->CourseName,
            'Credits' => $request->Credits,
        ]);

        return redirect()->route('instructor.courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course) // ✅ Dependency Injection
    {
        $course->delete();
        return redirect()->route('instructor.courses.index')->with('success', 'Course deleted successfully!');
    }
}

