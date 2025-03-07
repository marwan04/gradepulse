@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Plans</h1>
    <a href="{{ route('admin.plans.create') }}" class="btn btn-success mb-3">➕ Add New Plan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Plan ID</th>
                <th>Plan Name</th>
                <th>Required Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->PlanID }}</td>
                    <td>{{ $plan->PlanName }}</td>
                    <td>{{ $plan->RequiredCredits }}</td>
                    <td>
                        <a href="{{ route('admin.plans.edit', $plan->PlanID) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                        <form action="{{ route('admin.plans.destroy', $plan->PlanID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

