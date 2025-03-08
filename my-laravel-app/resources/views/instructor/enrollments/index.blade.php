@extends('layouts.app')

@section('title', 'Manage Student Marks')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary">📖 Manage Student Marks</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Numeric Mark</th>
                    <th>Alpha Mark</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->StudentName }}</td>
                        <td>{{ $enrollment->CourseName }}</td>
                        <td>{{ $enrollment->NumericMark }}</td>
                        <td>{{ $enrollment->AlphaMark }}</td>
                        <td>
                            <a href="{{ route('instructor.enrollments.edit', $enrollment->EnrollmentID) }}" 
                               class="btn btn-warning">✏ Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

