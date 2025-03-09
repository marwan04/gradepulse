@extends('layouts.app')

@section('title', 'Welcome to Grade Pulse')

@section('content')
    <!-- 🎨 Hero Section (Main Banner) -->
    <section class="hero text-center text-white d-flex align-items-center justify-content-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Track, Manage & Improve with Grade Pulse</h1>
            <p class="lead">A modern academic reporting system for seamless performance tracking.</p>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-3">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-accent">Register</a>
            </div>
        </div>
    </section>

    <!-- 🚀 Features Section -->
    <section id="features" class="container text-center py-5">
        <h2 class="mb-4 fw-bold text-primary">Why Choose Grade Pulse?</h2>
        <div class="row">
            <!-- 📊 Feature 1: Performance Analytics -->
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="feature-icon bi bi-graph-up"></i>
                    <h4 class="mt-3">Performance Analytics</h4>
                    <p>Real-time insights into student performance and trends.</p>
                </div>
            </div>

            <!-- 🔒 Feature 2: Secure & Reliable -->
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="feature-icon bi bi-lock"></i>
                    <h4 class="mt-3">Secure & Reliable</h4>
                    <p>Encrypted data protection for academic records.</p>
                </div>
            </div>

            <!-- 👥 Feature 3: Multi-User Access -->
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="feature-icon bi bi-people"></i>
                    <h4 class="mt-3">Multi-User Access</h4>
                    <p>Designed for students, teachers, and school administrators.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ⭐ Testimonials Section -->
    <section id="testimonials" class="testimonial text-center bg-light py-5">
        <h2 class="mb-4 fw-bold">What Educators Say</h2>
        <div class="container">
            <div class="row">
                <!-- 🗣️ Testimonial 1 -->
                <div class="col-md-4 fade-in">
                    <p class="fst-italic">"Grade Pulse simplifies academic reporting like never before!"</p>
                    <h5 class="fw-bold">- Prof. Emma L.</h5>
                </div>

                <!-- 🗣️ Testimonial 2 -->
                <div class="col-md-4 fade-in">
                    <p class="fst-italic">"An essential tool for administrators and teachers alike."</p>
                    <h5 class="fw-bold">- Dr. Mark W.</h5>
                </div>

                <!-- 🗣️ Testimonial 3 -->
                <div class="col-md-4 fade-in">
                    <p class="fst-italic">"Students and faculty love the intuitive interface and dashboards."</p>
                    <h5 class="fw-bold">- Principal Sarah J.</h5>
                </div>
            </div>
        </div>
    </section>
@endsection

