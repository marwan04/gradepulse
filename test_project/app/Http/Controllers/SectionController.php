<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('instructor.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('instructor.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'SectionName' => 'required|string|max:255',
            'CourseID' => 'required|exists:courses,id',
        ]);

        Section::create($request->all());

        return redirect()->route('instructor.sections.index')->with('success', 'Section created successfully!');
    }

    public function edit(Section $section)
    {
        return view('instructor.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'SectionName' => 'required|string|max:255',
            'CourseID' => 'required|exists:courses,id',
        ]);

        $section->update($request->all());

        return redirect()->route('instructor.sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('instructor.sections.index')->with('success', 'Section deleted successfully!');
    }
}

