@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">📘 Course Details</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary mb-3">⬅ Back to Courses</a>

    <div class="card">
        <div class="card-body">
            <h3>{{ $course->CourseName }}</h3>
            <p><strong>Credits:</strong> {{ $course->Credits }}</p>
        </div>
    </div>
</div>
@endsection

