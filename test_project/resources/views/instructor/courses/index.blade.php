@extends('layouts.app')

@section('title', 'Manage Courses')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">📚 Course Management</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Course Button -->
    <a href="{{ route('instructor.courses.create') }}" class="btn btn-primary mb-3">➕ Add New Course</a>

    <!-- Course Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->CourseName }}</td>
                    <td>{{ $course->Credits }}</td>
                    <td>
                        <!-- ✅ Corrected Edit Link -->
                        <a href="{{ route('instructor.courses.edit', $course) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                        <!-- ✅ Corrected DELETE FORM -->
                        <form action="{{ route('instructor.courses.destroy', $course) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

