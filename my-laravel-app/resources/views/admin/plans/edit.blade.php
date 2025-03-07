@extends('layouts.app')

@section('title', 'Edit Plan')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary">✏️ Edit Study Plan</h2>
        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary mb-3">⬅ Back to Plans</a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.plans.update', ['plan' => $plan['PlanID']]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="PlanName">Plan Name</label>
                <input type="text" name="PlanName" id="PlanName" class="form-control" required value="{{ old('PlanName', $plan['PlanName']) }}">
            </div>

            <div class="form-group">
                <label for="RequiredCredits">Required Credits</label>
                <input type="number" name="RequiredCredits" id="RequiredCredits" class="form-control" required value="{{ old('RequiredCredits', $plan['RequiredCredits']) }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">💾 Save Changes</button>
        </form>
    </div>
@endsection

