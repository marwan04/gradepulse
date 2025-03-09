@extends('layouts.app')

@section('title', 'Manage Plans')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">📋 Manage Plans</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    <!-- ✅ Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- 🔵 Add Plan Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.plans.create') }}" class="btn btn-primary">➕ Add New Plan</a>
    </div>

    <!-- 📋 Plans Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Plan ID</th>
                    <th>Plan Name</th>
                    <th>Required Credits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($plans as $plan)
                    <tr>
                        <td><strong>{{ $plan->PlanID }}</strong></td>
                        <td>{{ $plan->PlanName }}</td>
                        <td>{{ $plan->RequiredCredits }}</td>
                        <td>
                            <a href="{{ route('admin.plans.edit', $plan->PlanID) }}" class="btn btn-warning btn-sm">✏ Edit</a>

                            <form action="{{ route('admin.plans.destroy', $plan->PlanID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

