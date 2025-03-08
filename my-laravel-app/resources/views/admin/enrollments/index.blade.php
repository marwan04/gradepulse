@extends('layouts.app')

@section('title', 'Manage Enrollments')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">🎓 Enrollment Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary mb-3">➕ Add New Enrollment</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Enrollment ID</th>
                <th>Student</th>
                <th>Section</th>
                <th>Numeric Mark</th>
                <th>Alpha Mark</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->EnrollmentID }}</td>
                    <td>{{ $enrollment->student->Name ?? 'N/A' }}</td>
                    <td>{{ $enrollment->section->SectionID ?? 'N/A' }}</td>
                    <td>{{ $enrollment->NumericMark ?? '-' }}</td>
                    <td>{{ $enrollment->AlphaMark ?? '-' }}</td>
                    <td>{{ $enrollment->Completed ? '✅ Yes' : '❌ No' }}</td>
                    <td>
                        <a href="{{ route('admin.enrollments.edit', $enrollment->EnrollmentID) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.enrollments.destroy', $enrollment->EnrollmentID) }}" method="POST" style="display:inline;">
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

