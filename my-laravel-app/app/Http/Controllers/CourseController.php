<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

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
        return view('admin.courses.create');
    }

    /**
     * حفظ الكورس الجديد.
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

        return redirect()->route('admin.courses.index')->with('success', 'تم إضافة الكورس بنجاح!');
    }

    /**
     * إظهار نموذج تعديل كورس معين.
     */
public function edit($id)
{
    // البحث باستخدام CourseID وليس id
    $course = Course::where('CourseID', $id)->firstOrFail();

    return view('admin.courses.edit', compact('course'));
}



    /**
     * تحديث بيانات الكورس.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return abort(404);
        }

        $request->validate([
            'CourseName' => 'required|string|max:255',
            'Credits' => 'required|integer|min:1',
        ]);

        $course->update([
            'CourseName' => $request->CourseName,
            'Credits' => $request->Credits,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث الكورس بنجاح!');
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

