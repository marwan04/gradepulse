@extends('layouts.app')

@section('title', 'Create Section')

@section('content')
<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">📑 Create New Section</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">⬅ Back to Sections</a>
    </div>

    <hr>

    <div class="card shadow-sm border-0 p-4">
        <form method="POST" action="{{ route('admin.sections.store') }}">
            @csrf

            <!-- Semester Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">📅 Semester</label>
                <select class="form-select" name="semester" required>
                    <option value="Fall">🍂 Fall</option>
                    <option value="Spring">🌸 Spring</option>
                    <option value="Summer">☀ Summer</option>
                </select>
            </div>

            <!-- Year Input -->
            <div class="mb-3">
                <label class="form-label fw-bold">📆 Year</label>
                <input type="number" class="form-control" name="year" required min="2020">
            </div>

            <!-- Course Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">📚 Select Course</label>
                <select class="form-select" name="course_id" required>
                    @if(isset($courses) && $courses->count() > 0)
                        @foreach($courses as $course)
                            <option value="{{ $course->CourseID }}">{{ $course->CourseName }}</option>
                        @endforeach
                    @else
                        <option disabled>No Courses Available</option>
                    @endif
                </select>
            </div>

            <!-- Instructor Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">👨‍🏫 Assign Instructor</label>
                <select class="form-select" name="instructor_id" required>
                    @if(isset($instructors) && $instructors->count() > 0)
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->InstructorID }}">{{ $instructor->Name }}</option>
                        @endforeach
                    @else
                        <option disabled>No Instructors Available</option>
                    @endif
                </select>
            </div>

            <!-- ✅ Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-success">✅ Create Section</button>
            </div>
        </form>
    </div>
</div>
@endsection

