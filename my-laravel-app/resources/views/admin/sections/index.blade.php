@extends('layouts.app')

@section('title', 'Manage Sections')

@section('content')
<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">📑 Section Management</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    <!-- 🔵 Add Section Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">➕ Add New Section</a>
    </div>

    @if($sections->isEmpty())
        <div class="alert alert-info text-center fw-bold">⚠ No sections available. Start by adding a new section.</div>
    @else
        <!-- 📋 Section Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Semester</th>
                        <th>Year</th>
                        <th>Course ID</th>
                        <th>Instructor ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($sections as $section)
                        <tr>
                            <td><span class="badge bg-info p-2">{{ $section->Semester }}</span></td>
                            <td><strong>{{ $section->Year }}</strong></td>
                            <td>{{ $section->CourseID }}</td>
                            <td>{{ $section->InstructorID }}</td>
                            <td>
                                <!-- ✏️ Edit Button -->
                                <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                                <!-- 🗑 Delete Form -->
                                <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this section?')">🗑 Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

