@extends('layouts.app')

@section('title', 'Edit Plan')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-primary">✏️ Edit Study Plan</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">⬅ Back to Plans</a>
    </div>

    <hr>

    <!-- 🚨 Error Handling -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ✏️ Edit Plan Form -->
    <div class="card shadow-sm p-4">
        <form action="{{ route('admin.plans.update', ['plan' => $plan['PlanID']]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="PlanName" class="form-label fw-bold">Plan Name</label>
                <input type="text" name="PlanName" id="PlanName" class="form-control" required value="{{ old('PlanName', $plan['PlanName']) }}">
            </div>

            <div class="mb-3">
                <label for="RequiredCredits" class="form-label fw-bold">Required Credits</label>
                <input type="number" name="RequiredCredits" id="RequiredCredits" class="form-control" required value="{{ old('RequiredCredits', $plan['RequiredCredits']) }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">💾 Save Changes</button>
        </form>
    </div>
</div>

@endsection

