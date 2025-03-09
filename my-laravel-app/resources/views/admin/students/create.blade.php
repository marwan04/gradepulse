@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">➕ Add New Student</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">⬅ Back to Students</a>
    </div>

    <hr>

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

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('admin.students.store') }}" method="POST">
            @csrf

            <!-- Student ID -->
            <div class="mb-3">
                <label for="StudentID" class="form-label fw-bold">Student ID</label>
                <input type="number" name="StudentID" id="StudentID" class="form-control" required>
            </div>

            <!-- Student Name -->
            <div class="mb-3">
                <label for="Name" class="form-label fw-bold">Full Name</label>
                <input type="text" name="Name" id="Name" class="form-control" required>
            </div>

            <!-- Student Email -->
            <div class="mb-3">
                <label for="Email" class="form-label fw-bold">Email</label>
                <input type="email" name="Email" id="Email" class="form-control" required>
            </div>

            <!-- Select Plan -->
            <div class="mb-3">
                <label for="PlanID" class="form-label fw-bold">Plan</label>
                <select name="PlanID" id="PlanID" class="form-select">
                    <option value="">-- Select Plan --</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->PlanID }}">{{ $plan->PlanName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Default Password -->
            <div class="mb-3">
                <label for="Password" class="form-label fw-bold">Password (Default: <strong>default123!</strong>)</label>
                <input type="password" name="Password" id="Password" class="form-control" value="default123!" required readonly>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">✅ Save Student</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-danger">❌ Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

