@extends('layouts.app')

@section('title', 'Edit Enrollment')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">✏️ Edit Enrollment</h2>

    <!-- 🔙 Back to Enrollment Management -->
    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Enrollments</a>

    <!-- ✅ FIXED: Correct Route & Form Action -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.enrollments.update', $enrollment->EnrollmentID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Numeric Mark -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Numeric Mark</label>
                        <input type="number" name="NumericMark" class="form-control" value="{{ old('NumericMark', $enrollment->NumericMark) }}" step="0.01" min="0" max="100">
                    </div>

                    <!-- Alpha Mark -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alpha Mark</label>
                        <input type="text" name="AlphaMark" class="form-control" value="{{ old('AlphaMark', $enrollment->AlphaMark) }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Completed -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Completed</label>
                        <select name="Completed" class="form-control">
                            <option value="1" {{ $enrollment->Completed ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$enrollment->Completed ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Student Selection -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Student</label>
                        <select name="StudentID" class="form-control" required>
                            @foreach($students as $student)
                                <option value="{{ $student->StudentID }}" {{ $student->StudentID == $enrollment->StudentID ? 'selected' : '' }}>
                                    {{ $student->StudentID }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Section Selection -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Section</label>
                        <select name="SectionID" class="form-control" required>
                            @foreach($sections as $section)
                                <option value="{{ $section->SectionID }}" {{ $section->SectionID == $enrollment->SectionID ? 'selected' : '' }}>
                                    {{ $section->SectionID }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">✅ Update Enrollment</button>
            </form>
        </div>
    </div>
</div>
@endsection

