@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')
<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">✏️ Edit Section</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">⬅ Back to Sections</a>
    </div>

    <hr>

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('admin.sections.update', $section->SectionID) }}" method="POST">
            @csrf
            @method('PUT') <!-- Laravel requires this for PUT requests -->

            <!-- Semester Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">📅 Semester</label>
                <select name="semester" class="form-select" required>
                    <option value="Fall" {{ $section->Semester == 'Fall' ? 'selected' : '' }}>🍂 Fall</option>
                    <option value="Spring" {{ $section->Semester == 'Spring' ? 'selected' : '' }}>🌸 Spring</option>
                    <option value="Summer" {{ $section->Semester == 'Summer' ? 'selected' : '' }}>☀ Summer</option>
                </select>
            </div>

            <!-- Year Input -->
            <div class="mb-3">
                <label class="form-label fw-bold">📆 Year</label>
                <input type="number" class="form-control" name="year" value="{{ old('year', $section->Year) }}" required min="2020">
            </div>

            <!-- Course Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">📚 Select Course</label>
                <select name="course_id" class="form-select" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->CourseID }}" {{ $section->CourseID == $course->CourseID ? 'selected' : '' }}>
                            {{ $course->CourseName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Instructor Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">👨‍🏫 Assign Instructor</label>
                <select name="instructor_id" class="form-select" required>
                    @foreach($instructors as $instructor)
                        <option value="{{ $instructor->InstructorID }}" {{ $section->InstructorID == $instructor->InstructorID ? 'selected' : '' }}>
                            {{ $instructor->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- ✅ Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-success">✅ Update Section</button>
            </div>
        </form>
    </div>
</div>
@endsection

