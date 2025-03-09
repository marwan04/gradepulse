@extends('layouts.app')

@section('title', 'Manage Courses')

@section('content')
<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">📚 Course Management</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    <!-- 🔵 Add Course Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">➕ Add New Course</a>
    </div>

    <!-- 📋 Course Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Assigned Plans</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($courses as $course)
                    <tr>
                        <td><strong>{{ $course->CourseID }}</strong></td>
                        <td>{{ $course->CourseName }}</td>
                        <td>{{ $course->Credits }}</td>
                        <td>
                            @if($course->plans->isNotEmpty())
                                <ul class="list-unstyled m-0 p-0">
                                    @foreach($course->plans as $plan)
                                        <li class="badge bg-secondary p-2 m-1">{{ $plan->PlanID }} - {{ $plan->PlanName ?? 'N/A' }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No plans assigned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline">
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
</div>
@endsection

