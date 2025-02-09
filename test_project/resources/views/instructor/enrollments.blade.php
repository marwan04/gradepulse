@extends('layouts.app')

@section('title', 'Manage Enrollments')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Enrollments</h2>

    <div class="card p-4 mb-4">
        <h4>Add New Enrollment</h4>
        <form id="add-enrollment-form">
            @csrf
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" name="student_id" id="student-id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Course ID</label>
                <input type="text" name="course_id" id="course-id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Enrollment</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Existing Enrollments</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Course ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="enrollments-list">
                @foreach($enrollments as $enrollment)
                <tr id="enrollment-{{ $enrollment->id }}">
                    <td><input type="text" class="form-control" value="{{ $enrollment->student_id }}" id="student-{{ $enrollment->id }}"></td>
                    <td><input type="text" class="form-control" value="{{ $enrollment->course_id }}" id="course-{{ $enrollment->id }}"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="updateEnrollment({{ $enrollment->id }})">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteEnrollment({{ $enrollment->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-enrollment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('{{ route("enrollments.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        }).then(response => response.json()).then(() => { alert('Enrollment added successfully!'); location.reload(); });
    });

    function updateEnrollment(id) {
        let student_id = document.getElementById('student-' + id).value;
        let course_id = document.getElementById('course-' + id).value;

        fetch(`/enrollments/update/${id}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ student_id, course_id })
        }).then(response => response.json()).then(() => alert('Enrollment updated successfully!'));
    }

    function deleteEnrollment(id) {
        if (!confirm('Are you sure?')) return;

        fetch(`/enrollments/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => { document.getElementById('enrollment-' + id).remove(); alert('Enrollment deleted successfully!'); });
    }
</script>

@endsection
