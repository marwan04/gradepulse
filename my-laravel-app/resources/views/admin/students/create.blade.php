@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">➕ Add New Student</h2>

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

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="StudentID" class="form-label">Student ID</label>
            <input type="number" name="StudentID" id="StudentID" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Name" class="form-label">Full Name</label>
            <input type="text" name="Name" id="Name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" name="Email" id="Email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="PlanID" class="form-label">Plan</label>
            <select name="PlanID" id="PlanID" class="form-control">
                <option value="">-- Select Plan --</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->PlanID }}">{{ $plan->PlanName }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Password" class="form-label">Password (Default: <strong>default123!</strong>)</label>
            <input type="password" name="Password" id="Password" class="form-control" value="default123!" required readonly>
        </div>

        <button type="submit" class="btn btn-primary">Save Student</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

