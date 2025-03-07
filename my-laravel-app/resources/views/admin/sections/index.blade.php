@extends('layouts.app')

@section('title', 'Manage Sections')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary">📑 Section Management</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Section Button -->
    <a href="{{ route('admin.sections.create') }}" class="btn btn-primary mb-3">➕ Add New Section</a>

    @if($sections->isEmpty())
        <div class="alert alert-info">No sections available. Start by adding a new section.</div>
    @else
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Semester</th>
                    <th>Year</th>
                    <th>Course ID</th>
                    <th>Instructor ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                    <tr>
                        <td>{{ $section->Semester }}</td>
                        <td>{{ $section->Year }}</td>
                        <td>{{ $section->CourseID }}</td>
                        <td>{{ $section->InstructorID }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this section?')">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

