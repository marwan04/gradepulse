@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container mt-5">
    <h2 class="text-primary">🔒 Change Password</h2>
    <p>You must update your password before continuing.</p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <!-- New Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Update Password</button>
    </form>
</div>
@endsection

