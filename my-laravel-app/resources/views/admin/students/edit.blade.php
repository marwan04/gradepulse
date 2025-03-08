@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">✏️ Edit Student</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.update', $student->StudentID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="StudentID" class="form-label">Student ID</label>
            <input type="number" name="StudentID" id="StudentID" class="form-control" value="{{ $student->StudentID }}" readonly>
        </div>

        <div class="mb-3">
            <label for="Name" class="form-label">Full Name</label>
            <input type="text" name="Name" id="Name" class="form-control" value="{{ $student->Name }}" required>
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" name="Email" id="Email" class="form-control" value="{{ $student->Email }}" required>
        </div>

        <div class="mb-3">
            <label for="PlanID" class="form-label">Plan</label>
            <select name="PlanID" id="PlanID" class="form-control">
                <option value="">-- Select Plan --</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->PlanID }}" @if($student->PlanID == $plan->PlanID) selected @endif>
                        {{ $plan->PlanName }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Student</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

