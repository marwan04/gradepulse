@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')
    <section class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle text-primary" style="font-size: 60px;"></i>
                        <h4 class="mt-2">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">Instructor</p>
                        <hr>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.courses') }}">📚 Manage Courses</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.sections') }}">📑 Manage Sections</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.enrollments') }}">📋 Manage Enrollments</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.plans') }}">📜 Manage Plans</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.roles') }}">🛠 Manage Roles</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.progress') }}">📊 Student Progress</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('instructor.teams') }}">👥 Manage Teams</a></li>
                            <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ route('logout') }}">🚪 Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="fw-bold text-primary">📊 Instructor Dashboard</h2>
                        <p>Welcome back, <strong>{{ Auth::user()->name }}</strong>! Here’s an overview of your teaching activities.</p>
                        <hr>

                        <!-- Instructor Statistics -->
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-primary">📚 Courses Managed</h4>
                                    <h3 class="fw-bold">3</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-success">✅ Assignments Graded</h4>
                                    <h3 class="fw-bold">25</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-warning">🎓 Students Enrolled</h4>
                                    <h3 class="fw-bold">50</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Access to Management Forms -->
                        <div class="mt-4">
                            <h4 class="fw-bold">🔗 Quick Access</h4>
                            <div class="d-flex flex-wrap">
                                <a href="{{ route('instructor.courses') }}" class="btn btn-outline-primary m-2">Manage Courses</a>
                                <a href="{{ route('instructor.sections') }}" class="btn btn-outline-secondary m-2">Manage Sections</a>
                                <a href="{{ route('instructor.enrollments') }}" class="btn btn-outline-success m-2">Manage Enrollments</a>
                                <a href="{{ route('instructor.plans') }}" class="btn btn-outline-warning m-2">Manage Plans</a>
                                <a href="{{ route('instructor.roles') }}" class="btn btn-outline-dark m-2">Manage Roles</a>
                                <a href="{{ route('instructor.progress') }}" class="btn btn-outline-info m-2">Student Progress</a>
                                <a href="{{ route('instructor.teams') }}" class="btn btn-outline-danger m-2">Manage Teams</a>
                            </div>
                        </div>

                        <!-- Courses Section -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📚 My Courses</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Data Structures</h5>
                                            <p class="text-muted">Semester 2</p>
                                            <a href="{{ route('instructor.courses') }}" class="btn btn-primary btn-sm">Manage Course</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Database Management</h5>
                                            <p class="text-muted">Semester 1</p>
                                            <a href="{{ route('instructor.courses') }}" class="btn btn-primary btn-sm">Manage Course</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="fw-bold">Machine Learning</h5>
                                            <p class="text-muted">Semester 3</p>
                                            <a href="{{ route('instructor.courses') }}" class="btn btn-primary btn-sm">Manage Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📌 Quick Actions</h4>
                            <div class="d-flex flex-wrap">
                                <a href="{{ route('instructor.progress') }}" class="btn btn-outline-primary m-2">Update Student Progress</a>
                                <a href="{{ route('instructor.teams') }}" class="btn btn-outline-success m-2">Manage Teams</a>
                                <a href="#" class="btn btn-outline-warning m-2">Manage Grades</a>
                                <a href="#" class="btn btn-outline-danger m-2">Send Announcement</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
