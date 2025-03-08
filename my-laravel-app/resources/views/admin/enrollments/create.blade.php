@extends('layouts.app')

@section('title', 'Add Enrollment')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">➕ Add Enrollment</h2>

    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Enrollments</a>

    <form action="{{ route('admin.enrollments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="StudentID" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->StudentID }}">{{ $student->Name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Section</label>
            <select name="SectionID" class="form-control" required>
                @foreach($sections as $section)
                    <option value="{{ $section->SectionID }}">{{ $section->SectionID }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">✅ Create Enrollment</button>
    </form>
</div>
@endsection

