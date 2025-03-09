@extends('layouts.app')

@section('title', "📊 Grades for $semester")

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="fw-bold text-primary text-center">📊 Grades for {{ $semester }}</h2>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('student.grades.index') }}" class="btn btn-outline-secondary">⬅ Back to All Semesters</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Course</th>
                            <th>Numeric Grade</th>
                            <th>Alphabetic Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semesterGrades as $grade)
                            <tr>
                                <td class="fw-bold">{{ $grade->section->course->CourseName }}</td>
                                <td><span class="badge bg-primary fs-6">{{ $grade->NumericMark }}</span></td>
                                <td><span class="badge bg-secondary fs-6">{{ $grade->alphaMark }}</span></td>
                                <td>
                                    <span class="badge {{ $grade->Completed ? 'bg-success' : 'bg-warning' }} fs-6">
                                        {{ $grade->Completed ? 'Completed' : 'Ongoing' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-danger fw-bold">No grades available for this semester</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

