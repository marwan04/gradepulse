@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">✏ Edit Student Mark</h2>

    <form action="{{ route('instructor.enrollments.update', $enrollment->EnrollmentID) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" class="form-control" value="{{ $enrollment->student->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Numeric Mark</label>
            <input type="number" name="NumericMark" class="form-control" value="{{ $enrollment->NumericMark }}" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
        <a href="{{ route('instructor.enrollments.index') }}" class="btn btn-secondary">🔙 Back</a>
    </form>
</div>
@endsection
