@extends('layouts.app')

@section('title', 'Manage Instructors')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">👨‍🏫 Manage Instructors</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary mb-3">➕ Add New Instructor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Instructor ID</th>
                <th>Instructor Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->InstructorID ?? 'No ID' }}</td>
                    <td>{{ $instructor->Name ?? 'No Name' }}</td>
                    <td>{{ $instructor->Email ?? 'No Email' }}</td>
                    <td>{{ $instructor->Phone ?? 'No Phone' }}</td>
                    <td>{{ $instructor->RoleID ?? 'No Role ID' }}</td>
                    <td>
                        @if(isset($instructor->InstructorID) && !empty($instructor->InstructorID))
                            <!-- رابط التعديل بعد التعديل -->
                            <a href="{{ route('admin.instructors.edit', ['instructor' => $instructor->InstructorID]) }}" class="btn btn-warning btn-sm">
                                ✏️ Edit
                            </a>

                            <!-- زر الحذف بعد التعديل -->
                            <form action="{{ route('admin.instructors.destroy', ['instructor' => $instructor->InstructorID]) }}" method="POST" style="display:inline;">
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
@endsection

