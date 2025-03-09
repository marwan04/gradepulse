@extends('layouts.app')

@section('title', 'Manage My Sections')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">📚 My Sections</h2>

        <!-- 🔙 Back to Dashboard -->
        <a href="{{ route('instructor.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    <!-- ✅ Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ➕ Add New Section Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('instructor.sections.create') }}" class="btn btn-success">➕ Add New Section</a>
    </div>

    <!-- 🚨 Ensure Sections Exist -->
    @if($sections->isEmpty())
        <div class="alert alert-info text-center">
            <p class="mb-0">📌 No sections found. Start by adding a new section!</p>
        </div>
    @else
        <!-- 📌 Sections Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>📖 Section ID</th>
                        <th>📅 Semester</th>
                        <th>📆 Year</th>
                        <th>📘 Course</th>
                        <th>⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($sections as $section)
                        <tr>
                            <td><strong>{{ $section->SectionID }}</strong></td>
                            <td>{{ $section->Semester }}</td>
                            <td>{{ $section->Year }}</td>
                            <td>{{ $section->course->CourseName ?? 'Unknown Course' }}</td>
                            <td>
                                <!-- ✏️ Edit Section -->
                                <a href="{{ route('instructor.sections.edit', $section->SectionID) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                                <!-- ❌ No Delete Button (Instructors can't delete) -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection

