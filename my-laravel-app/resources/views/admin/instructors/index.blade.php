@extends('layouts.app')

@section('title', 'Manage Instructors')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">👨‍🏫 Manage Instructors</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    <!-- 🔵 Add Instructor Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary">➕ Add New Instructor</a>
    </div>

    <!-- 📋 Instructor Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Instructor ID</th>
                    <th>Instructor Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($instructors as $instructor)
                    <tr>
                        <td><strong>{{ $instructor->InstructorID ?? 'No ID' }}</strong></td>
                        <td>{{ $instructor->Name ?? 'No Name' }}</td>
                        <td>{{ $instructor->Email ?? 'No Email' }}</td>
                        <td>{{ $instructor->Phone ?? 'No Phone' }}</td>
                        <td>{{ $instructor->RoleID ?? 'No Role ID' }}</td>
                        <td>
                            @if(isset($instructor->InstructorID) && !empty($instructor->InstructorID))
                                <!-- ✏️ Edit Button -->
                                <a href="{{ route('admin.instructors.edit', ['instructor' => $instructor->InstructorID]) }}" class="btn btn-warning btn-sm">
                                    ✏️ Edit
                                </a>

                                <!-- 🗑 Delete Button -->
                                <form action="{{ route('admin.instructors.destroy', ['instructor' => $instructor->InstructorID]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</button>
                                </form>
                            @else
                                <span class="text-muted">No ID Available</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No instructors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

