@extends('layouts.app')

@section('title', 'Manage My Sections')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">📚 My Sections</h2>

    <!-- ✅ Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- ➕ Add New Section Button -->
    <a href="{{ route('instructor.sections.create') }}" class="btn btn-success mb-3">➕ Add New Section</a>

    <!-- 🚨 Ensure Sections Exist -->
    @if($sections->isEmpty())
        <p class="text-muted">No sections found. Create a new section to get started!</p>
    @else
        <!-- 📌 Sections Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>📖 Section ID</th>
                    <th>📅 Semester</th>
                    <th>📆 Year</th>
                    <th>📘 Course</th>
                    <th>⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                    <tr>
                        <td>{{ $section->SectionID }}</td>
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
    @endif
</div>
@endsection
