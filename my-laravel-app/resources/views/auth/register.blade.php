@extends('layouts.app')

@section('title', 'Register for Grade Pulse')

@section('content')
    <section class="hero d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h2 class="text-center text-primary fw-bold mb-3">Create an Account</h2>
                            <p class="text-center text-muted">Sign up to get started with Grade Pulse</p>

                            <!-- Registration Form -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- ID Field -->
                                <div class="mb-3">
                                    <label for="user_id" class="form-label fw-bold">ID</label>
                                    <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required>
                                    @error('user_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label fw-bold">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <!-- Register Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-accent">Register</button>
                                </div>

                                <!-- Already have an account -->
                                <p class="text-center mt-3">
                                    Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold">Sign In</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection