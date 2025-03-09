@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">✏️ Edit Section</h2>

        <!-- 🔙 Back to Sections -->
        <a href="{{ route('instructor.sections.index') }}" class="btn btn-secondary">⬅ Back to Sections</a>
    </div>

    <hr>

    <!-- ✅ Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- 🚨 Error Handling -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ✏️ Edit Section Form -->
    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('instructor.sections.update', $section->SectionID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">📅 Semester</label>
                <input type="text" name="Semester" class="form-control" value="{{ old('Semester', $section->Semester) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📆 Year</label>
                <input type="number" name="Year" class="form-control" value="{{ old('Year', $section->Year) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📘 Course ID</label>
                <input type="number" name="CourseID" class="form-control" value="{{ old('CourseID', $section->CourseID) }}" required>
            </div>

            <button type="submit" class="btn btn-success">✅ Update Section</button>
        </form>
    </div>
</div>

@endsection

