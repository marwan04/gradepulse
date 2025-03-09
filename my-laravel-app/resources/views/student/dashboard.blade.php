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
                        <h4 class="mt-2">{{ Auth::guard('student')->user()->name ?? 'Guest' }}</h4>
                        <p class="text-muted">Student</p>
                        <hr>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="#">📚 My Courses</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="#">📄 Assignments</a></li>
                            <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('student.grades.index') }}">📊 Grade Reports</a></li>
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
                        <p>Welcome back, <strong>{{ Auth::guard('student')->user()->name ?? 'Guest' }}</strong>! Here's an overview of your academic performance.</p>
                        <hr>

                        <!-- Student Statistics -->
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-primary">📚 Courses Enrolled</h4>
                                    <h3 class="fw-bold">{{ $totalCourses ?? '0' }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-success">✅ Assignments Completed</h4>
                                    <h3 class="fw-bold">{{ $completedAssignments ?? '0' }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm border-0 p-3">
                                    <h4 class="text-warning">📊 GPA</h4>
                                    <h3 class="fw-bold">{{ $gpa ?? 'N/A' }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Grade Reports Section -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📊 Grade Reports</h4>
                            <p>View your grades for all semesters or select a specific semester.</p>

                            <div class="d-flex flex-wrap">
                                <a href="{{ route('student.grades.index') }}" class="btn btn-outline-primary m-2">📊 View All Grades</a>

                                <!-- Show available semesters -->
                                @foreach($semesters as $semester)
                                    <a href="{{ route('student.grades.semester', ['semester' => $semester]) }}" class="btn btn-outline-success m-2">
                                        {{ $semester }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Courses Section -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📚 My Courses</h4>
                            <div class="row">
                                @forelse($courses as $course)
                                    <div class="col-md-4">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-body">
                                                <h5 class="fw-bold">{{ $course->CourseName }}</h5>
                                                <p class="text-muted">
                                                    {{ $course->instructor->Name ?? 'No Instructor Assigned' }}
                                                </p>
                                                <a href="#" class="btn btn-primary btn-sm">View Course</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-danger fw-bold mt-3">⚠ No courses enrolled.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-4">
                            <h4 class="fw-bold">📌 Quick Actions</h4>
                            <div class="d-flex flex-wrap">
                                <a href="{{ route('student.grades.index') }}" class="btn btn-outline-primary m-2">📊 View Grades</a>
                                <a href="#" class="btn btn-outline-success m-2">📄 Submit Assignment</a>
                                <a href="#" class="btn btn-outline-warning m-2">📥 Download Report</a>
                                <a href="#" class="btn btn-outline-danger m-2">📞 Contact Instructor</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

