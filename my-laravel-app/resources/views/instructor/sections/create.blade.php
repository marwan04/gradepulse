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
        <h2 class="fw-bold text-primary">📚 Create a New Section</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('instructor.sections.index') }}" class="btn btn-secondary">⬅ Back to Sections</a>
    </div>

    <hr>

    <!-- 🚨 Error Handling -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ✅ Create Section Form -->
    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('instructor.sections.store') }}" method="POST">
            @csrf

            <!-- Semester Dropdown -->
            <div class="mb-3">
                <label class="form-label fw-bold">📅 Semester</label>
                <select name="Semester" class="form-select" required>
                    <option value="">Select Semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester }}">{{ $semester }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Year Input -->
            <div class="mb-3">
                <label class="form-label fw-bold">📆 Year</label>
                <input type="number" name="Year" class="form-control" min="2020" required>
            </div>

            <!-- Course Selection -->
            <div class="mb-3">
                <label class="form-label fw-bold">📘 Course</label>
                <select name="CourseID" class="form-select" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->CourseID }}">{{ $course->CourseName }} (ID: {{ $course->CourseID }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">✅ Create Section</button>
        </form>
    </div>
</div>

@endsection

