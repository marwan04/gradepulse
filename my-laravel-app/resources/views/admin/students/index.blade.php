@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">🎓 Manage Students</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ➕ Add New Student Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">➕ Add New Student</a>
    </div>

    <!-- 📋 Student Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($students as $student)
                    <tr>
                        <td><strong>{{ $student->StudentID }}</strong></td>
                        <td>{{ $student->Name }}</td>
                        <td>{{ $student->Email }}</td>
                        <td>{{ $student->Phone ?? 'N/A' }}</td>
                        <td>{{ $student->RoleID ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.students.edit', $student->StudentID) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                            <form action="{{ route('admin.students.destroy', $student->StudentID) }}" method="POST" class="d-inline">
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

