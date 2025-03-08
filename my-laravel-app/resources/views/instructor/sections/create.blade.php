@extends('layouts.app')

@section('title', 'Create Section')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">📚 Create a New Section</h2>

    <a href="{{ route('instructor.sections.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Sections</a>

    <form action="{{ route('instructor.sections.store') }}" method="POST">
        @csrf

        <!-- Semester Dropdown -->
        <div class="mb-3">
            <label class="form-label">Semester</label>
            <select name="Semester" class="form-control" required>
                <option value="">Select Semester</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester }}">{{ $semester }}</option>
                @endforeach
            </select>
        </div>

        <!-- Year Input -->
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="Year" class="form-control" required>
        </div>

        <!-- Course Selection -->
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="CourseID" class="form-control" required>
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->CourseID }}">{{ $course->CourseName }} (ID: {{ $course->CourseID }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">✅ Create Section</button>
    </form>
</div>
@endsection
