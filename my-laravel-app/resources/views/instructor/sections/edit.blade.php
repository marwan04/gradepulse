@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">✏️ Edit Section</h2>

    <a href="{{ route('instructor.sections.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Sections</a>

    <form action="{{ route('instructor.sections.update', $section->SectionID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <input type="text" name="Semester" class="form-control" value="{{ old('Semester', $section->Semester) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="Year" class="form-control" value="{{ old('Year', $section->Year) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course ID</label>
            <input type="number" name="CourseID" class="form-control" value="{{ old('CourseID', $section->CourseID) }}" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Update Section</button>
    </form>
</div>
@endsection

