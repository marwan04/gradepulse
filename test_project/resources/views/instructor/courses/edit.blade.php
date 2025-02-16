@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">✏️ Edit Course</h2>

    <!-- 🔙 Back to Course Management -->
    <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Courses</a>

    <!-- ✅ FIXED: Correct Route & Form Action -->
    <form action="{{ route('instructor.courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Course Name -->
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="CourseName" class="form-control" value="{{ old('CourseName', $course->CourseName) }}" required>
        </div>

        <!-- Course Credits -->
        <div class="mb-3">
            <label class="form-label">Credits</label>
            <input type="number" name="Credits" class="form-control" value="{{ old('Credits', $course->Credits) }}" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Update Course</button>
    </form>
</div>
@endsection

