@extends('layouts.app')

@section('title', 'Add New Section')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">📑 Add New Section</h2>

    <a href="{{ route('instructor.sections.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Sections</a>

    <form action="{{ route('instructor.sections.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Section Name</label>
            <input type="text" name="SectionName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course ID</label>
            <input type="number" name="CourseID" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Create Section</button>
    </form>
</div>
@endsection

