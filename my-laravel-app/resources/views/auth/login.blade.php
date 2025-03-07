@extends('layouts.app')

@section('title', 'Login to Grade Pulse')

@section('content')
    <section class="hero d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h2 class="text-center text-primary fw-bold mb-3">Welcome Back</h2>
                            <p class="text-center text-muted">Login to access your account</p>

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="text-primary">Forgot Password?</a>
                                </div>

                                <!-- Login Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-accent">Login</button>
                                </div>

                                <!-- Register Link -->
                                <p class="text-center mt-3">
                                    Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-bold">Sign Up</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection