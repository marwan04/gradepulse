@extends('layouts.app')

@section('title', 'Cumulative Academic Record')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="fw-bold text-primary text-center">📊 Cumulative Academic Record</h2>

            <!-- Student Progress Summary -->
            @if($studentProgress)
                <div class="alert alert-info text-center">
                    <h5><strong>Total Credits Earned:</strong> {{ $studentProgress->TotalCreditsEarned ?? 'N/A' }}</h5>
                    <h5><strong>Graduation Status:</strong> 
                        <span class="badge {{ $studentProgress->GraduationStatus ? 'bg-success' : 'bg-warning' }}">
                            {{ $studentProgress->GraduationStatus ? 'Completed' : 'In Progress' }}
                        </span>
                    </h5>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    ⚠ No student progress data available.
                </div>
            @endif

            <!-- Filter by Semester -->
            <h4 class="fw-bold mt-4">📅 Filter by Semester:</h4>
            <div class="d-flex flex-wrap">
                <a href="{{ route('student.grades.index') }}" class="btn btn-outline-primary m-2">📊 View All Grades</a>
                @foreach($semesters as $semester)
                    <a href="{{ route('student.grades.semester', ['semester' => $semester]) }}" class="btn btn-outline-success m-2">
                        {{ $semester }}
                    </a>
                @endforeach
            </div>

            <!-- Grades Table -->
            <div class="mt-4">
                <h4 class="fw-bold">📜 Grade Report</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Semester</th>
                                <th>Course</th>
                                <th>Numeric Grade</th>
                                <th>Alphabetic Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grades as $grade)
                                <tr>
                                    <td>{{ $grade->section->Semester }}</td>
                                    <td>{{ $grade->section->course->CourseName }}</td>
                                    <td><span class="badge bg-primary">{{ $grade->NumericMark }}</span></td>
                                    <td><span class="badge bg-secondary">{{ $grade->alphaMark }}</span></td>
                                    <td>
                                        <span class="badge {{ $grade->Completed ? 'bg-success' : 'bg-warning' }}">
                                            {{ $grade->Completed ? 'Completed' : 'Ongoing' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger">No grades available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

