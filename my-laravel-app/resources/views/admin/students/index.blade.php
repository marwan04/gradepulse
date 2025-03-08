@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">🎓 Manage Students</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">➕ Add New Student</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->StudentID }}</td>
                    <td>{{ $student->Name }}</td>
                    <td>{{ $student->Email }}</td>
                    <td>{{ $student->Phone }}</td>
                    <td>{{ $student->RoleID }}</td>
                    <td>
                        <a href="{{ route('admin.students.edit', $student->StudentID) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.students.destroy', $student->StudentID) }}" method="POST" style="display:inline;">
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

