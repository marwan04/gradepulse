@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">✏️ Edit Course</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">⬅ Back to Courses</a>
    </div>

    <hr>

    <!-- 📋 Edit Course Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.courses.update', $course->CourseID) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- 📌 Course ID (Non-editable) -->
                <div class="mb-3">
                    <label class="form-label fw-bold">📌 Course ID</label>
                    <input type="number" name="CourseID" class="form-control" value="{{ $course->CourseID }}" readonly>
                </div>

                <!-- 📚 Course Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">📚 Course Name</label>
                    <input type="text" name="CourseName" class="form-control" value="{{ old('CourseName', $course->CourseName) }}" required>
                </div>

                <!-- 🎓 Course Credits -->
                <div class="mb-3">
                    <label class="form-label fw-bold">🎓 Credits</label>
                    <input type="number" name="Credits" class="form-control" value="{{ old('Credits', $course->Credits) }}" required>
                </div>

                <!-- 📖 Assign to Plans -->
                <div class="mb-3">
                    <label class="form-label fw-bold">📖 Assign to Plans</label>
                    <select name="plans[]" class="form-control" multiple required>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->PlanID }}" 
                                {{ in_array($plan->PlanID, $selectedPlans) ? 'selected' : '' }}>
                                {{ $plan->PlanID }} - {{ $plan->PlanName ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple plans.</small>
                </div>

                <!-- ✅ Update Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">✅ Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

