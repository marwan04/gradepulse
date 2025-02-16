@extends('layouts.app')

@section('title', 'Manage Sections')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">📑 Section Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('instructor.sections.create') }}" class="btn btn-primary mb-3">➕ Add New Section</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Section Name</th>
                <th>Course ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
                <tr>
                    <td>{{ $section->SectionName }}</td>
                    <td>{{ $section->CourseID }}</td>
                    <td>
                        <a href="{{ route('instructor.sections.edit', $section) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('instructor.sections.destroy', $section) }}" method="POST" style="display:inline;">
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

