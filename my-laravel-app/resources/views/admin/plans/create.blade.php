@extends('layouts.app')

@section('title', 'Add New Plan')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">➕ Add New Study Plan</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">⬅ Back to Plans</a>
    </div>

    <hr>

    <!-- ✏️ Create Plan Form -->
    <div class="card shadow-sm p-4">
        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="PlanName" class="form-label fw-bold">Plan Name</label>
                <input type="text" name="PlanName" id="PlanName" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="RequiredCredits" class="form-label fw-bold">Required Credits</label>
                <input type="number" name="RequiredCredits" id="RequiredCredits" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">✅ Save Plan</button>
        </form>
    </div>
</div>

@endsection

