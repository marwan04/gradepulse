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
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">➕ Add New Course</a>

    <!-- Course Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course ID</th> <!-- ✅ Added Course ID Column -->
                <th>Course Name</th>
                <th>Credits</th>
                <th>Assigned Plans</th> <!-- ✅ New Column for Assigned Plans -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->CourseID }}</td> <!-- ✅ Display Course ID -->
                    <td>{{ $course->CourseName }}</td>
                    <td>{{ $course->Credits }}</td>
                    <td>
                        @if($course->plans->isNotEmpty())
                            <ul>
                                @foreach($course->plans as $plan)
                                    <li>{{ $plan->PlanID }} - {{ $plan->PlanName ?? 'N/A' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No plans assigned</span>
                        @endif
                    </td>
                    <td>
                        <!-- ✅ Corrected Edit Link -->
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                        <!-- ✅ Corrected DELETE FORM -->
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display:inline;">
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

