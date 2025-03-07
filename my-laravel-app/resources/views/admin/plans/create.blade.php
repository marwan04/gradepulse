@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Plan</h1>
    <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary mb-3">⬅ Back to Plans</a>

    <form action="{{ route('admin.plans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="PlanName">Plan Name</label>
            <input type="text" name="PlanName" id="PlanName" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="RequiredCredits">Required Credits</label>
            <input type="number" name="RequiredCredits" id="RequiredCredits" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Plan</button>
    </form>
</div>
@endsection
