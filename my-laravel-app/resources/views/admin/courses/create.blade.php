@extends('layouts.app')

@section('title', 'Add New Course')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">➕ Add New Course</h2>

    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary mb-3">⬅️ Back to Courses</a>

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <!-- ✅ Manually Enter Course ID -->
        <div class="mb-3">
            <label class="form-label">Course ID</label>
            <input type="number" name="CourseID" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="CourseName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Credits</label>
            <input type="number" name="Credits" class="form-control" required>
        </div>

        <!-- ✅ Assign Course to Plans -->
        <div class="mb-3">
            <label class="form-label">Assign to Plans</label>
            <select name="plans[]" class="form-control" multiple required>
                @foreach($plans as $plan)
                    <option value="{{ $plan->PlanID }}">{{ $plan->PlanID }} - {{ $plan->PlanName ?? 'N/A' }}</option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple plans.</small>
        </div>

        <button type="submit" class="btn btn-success">✅ Create Course</button>
    </form>
</div>
@endsection

