<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    /**
     * عرض قائمة الأقسام
     */
    public function index()
    {
        $sections = Section::with(['course', 'instructor'])->get();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * عرض نموذج إضافة قسم جديد
     */
    public function create()
    {
        $courses = Course::all(); 
        $instructors = Instructor::all(); 

        return view('admin.sections.create', compact('courses', 'instructors'));
    }

    /**
     * تخزين قسم جديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|string|max:20',
            'year' => 'required|integer|min:2020',
            'course_id' => 'required|exists:Course,CourseID',
            'instructor_id' => 'required|exists:Instructor,InstructorID',
        ]);

        Section::create([
            'Semester' => $request->input('semester'),
            'Year' => $request->input('year'),
            'CourseID' => $request->input('course_id'),
            'InstructorID' => $request->input('instructor_id'),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'تم إنشاء القسم بنجاح!');
    }

    /**
     * عرض نموذج تعديل قسم معين
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id); // ✅ جلب القسم من قاعدة البيانات
        $courses = Course::all();
        $instructors = Instructor::all();
        
        return view('admin.sections.edit', compact('section', 'courses', 'instructors'));
    }

    /**
     * تحديث بيانات القسم
     */
    public function update(Request $request, $id)
    {
        Log::info("📌 تحديث القسم: ID => " . $id);
        Log::info("📌 البيانات القادمة من الفورم: ", $request->all());

        try {
            $validatedData = $request->validate([
                'semester' => 'required|string|max:20',
                'year' => 'required|integer|min:2020',
                'course_id' => 'required|exists:Course,CourseID',
                'instructor_id' => 'required|exists:Instructor,InstructorID',
            ]);

            Log::info("✅ التحقق من البيانات ناجح!", $validatedData);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("❌ فشل التحقق من البيانات!", $e->errors());
            return redirect()->back()->withErrors($e->errors());
        }

        $section = Section::findOrFail($id);
        Log::info("✅ القسم قبل التحديث: ", $section->toArray());

        // ✅ تنفيذ التحديث
        $section->update([
            'Semester' => $request->input('semester'),
            'Year' => $request->input('year'),
            'CourseID' => $request->input('course_id'),
            'InstructorID' => $request->input('instructor_id'),
        ]);

        Log::info("✅ القسم بعد التحديث: ", $section->toArray());

        return redirect()->route('admin.sections.index')->with('success', 'تم تحديث القسم بنجاح!');
    }

    /**
     * حذف القسم
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return redirect()->route('admin.sections.index')->with('success', 'تم حذف القسم بنجاح!');
    }
}

