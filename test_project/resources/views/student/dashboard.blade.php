@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <section class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle text-primary" style="font-size: 60px;"></i>
                        <h4 class="mt-2">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">Student</p>
                        <hr>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="#">📚 My Courses</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="#">📄 Assignments</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="#">📊 Grade Reports</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="#">⚙️ Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="fw-bold text-primary">📊 Student Dashboard</h2>
                        <p>Welcome back, <strong>{{ Auth::user()->name }}</strong>! Here's an overview of your academic performance.</p>
                        <hr>

                        <!-- Student Statistics -->
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-primary">📚 Courses Enrolled</h4>
                                    <h3 class="fw-bold">5</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-success">✅ Assignments Completed</h4>
                                    <h3 class="fw-bold">12</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-warning">📊 GPA</h4>
                                    <h3 class="fw-bold">3.8</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Courses Section -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📚 My Courses</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Mathematics</h5>
                                            <p class="text-muted">Prof. John Doe</p>
                                            <a href="#" class="btn btn-primary btn-sm">View Course</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Computer Science</h5>
                                            <p class="text-muted">Dr. Jane Smith</p>
                                            <a href="#" class="btn btn-primary btn-sm">View Course</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Physics</h5>
                                            <p class="text-muted">Dr. Albert Einstein</p>
                                            <a href="#" class="btn btn-primary btn-sm">View Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📌 Quick Actions</h4>
                            <div class="d-flex flex-wrap">
                                <a href="#" class="btn btn-outline-primary m-2">View Grades</a>
                                <a href="#" class="btn btn-outline-success m-2">Submit Assignment</a>
                                <a href="#" class="btn btn-outline-warning m-2">Download Report</a>
                                <a href="#" class="btn btn-outline-danger m-2">Contact Instructor</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection