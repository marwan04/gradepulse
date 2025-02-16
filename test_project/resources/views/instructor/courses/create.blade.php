@extends('layouts.app')

@section('title', 'Add New Course')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">➕ Add New Course</h2>

    <!-- ✅ FIXED: Use Correct Route Name -->
    <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Courses</a>

    <form action="{{ route('instructor.courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="CourseName" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Credits</label>
            <input type="number" name="Credits" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">✅ Create Course</button>
    </form>
</div>
@endsection

