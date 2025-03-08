@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">✏️ Edit Course</h2>

    <!-- 🔙 Back to Course Management -->
    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Courses</a>

    <form action="{{ route('admin.courses.update', $course->CourseID) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Course ID (Non-editable) -->
        <div class="mb-3">
            <label class="form-label">Course ID</label>
            <input type="number" name="CourseID" class="form-control" value="{{ $course->CourseID }}" readonly>
        </div>

        <!-- Course Name -->
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="CourseName" class="form-control" value="{{ old('CourseName', $course->CourseName) }}" required>
        </div>

        <!-- Course Credits -->
        <div class="mb-3">
            <label class="form-label">Credits</label>
            <input type="number" name="Credits" class="form-control" value="{{ old('Credits', $course->Credits) }}" required>
        </div>

        <!-- Assign Course to Plans -->
        <div class="mb-3">
            <label class="form-label">Assign to Plans</label>
            <select name="plans[]" class="form-control" multiple required>
                @foreach($plans as $plan)
                    <option value="{{ $plan->PlanID }}" 
                        {{ in_array($plan->PlanID, $selectedPlans) ? 'selected' : '' }}>
                        {{ $plan->PlanID }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple plans.</small>
        </div>

        <button type="submit" class="btn btn-success">✅ Update Course</button>
    </form>
</div>
@endsection

