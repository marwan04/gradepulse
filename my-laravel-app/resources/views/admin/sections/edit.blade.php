@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">✏️ Edit Section</h2>

    <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Sections</a>

    <form action="{{ route('admin.sections.update', $section->SectionID) }}" method="POST">
        @csrf
        @method('PUT') <!-- Laravel requires this for PUT requests -->

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <select name="semester" class="form-control" required>
                <option value="Fall" {{ $section->Semester == 'Fall' ? 'selected' : '' }}>Fall</option>
                <option value="Spring" {{ $section->Semester == 'Spring' ? 'selected' : '' }}>Spring</option>
                <option value="Summer" {{ $section->Semester == 'Summer' ? 'selected' : '' }}>Summer</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year', $section->Year) }}" required min="2020">
        </div>

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->CourseID }}" {{ $section->CourseID == $course->CourseID ? 'selected' : '' }}>
                        {{ $course->CourseName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Instructor</label>
            <select name="instructor_id" class="form-control" required>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->InstructorID }}" {{ $section->InstructorID == $instructor->InstructorID ? 'selected' : '' }}>
                        {{ $instructor->Name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">✅ Update Section</button>
    </form>
</div>
@endsection

