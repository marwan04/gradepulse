@extends('layouts.app')

@section('title', 'Manage Student Progress')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Student Progress</h2>

    <div class="card p-4 mb-4">
        <h4>Add Student Progress</h4>
        <form id="add-progress-form">
            @csrf
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" name="student_id" id="student-id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Course ID</label>
                <input type="text" name="course_id" id="course-id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="progress" class="form-label">Progress (%)</label>
                <input type="number" name="progress" id="progress" class="form-control" required min="0" max="100">
            </div>
            <button type="submit" class="btn btn-primary">Add Progress</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Existing Progress</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Course ID</th>
                    <th>Progress (%)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="progress-list">
                @foreach($progress as $entry)
                <tr id="progress-{{ $entry->id }}">
                    <td><input type="text" class="form-control" value="{{ $entry->student_id }}" id="student-{{ $entry->id }}"></td>
                    <td><input type="text" class="form-control" value="{{ $entry->course_id }}" id="course-{{ $entry->id }}"></td>
                    <td><input type="number" class="form-control" value="{{ $entry->progress }}" id="progress-{{ $entry->id }}"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="updateProgress({{ $entry->id }})">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteProgress({{ $entry->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-progress-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('{{ route("progress.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        }).then(response => response.json()).then(() => { alert('Progress added successfully!'); location.reload(); });
    });

    function updateProgress(id) {
        let student_id = document.getElementById('student-' + id).value;
        let course_id = document.getElementById('course-' + id).value;
        let progress = document.getElementById('progress-' + id).value;

        fetch(`/progress/update/${id}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ student_id, course_id, progress })
        }).then(response => response.json()).then(() => alert('Progress updated successfully!'));
    }

    function deleteProgress(id) {
        if (!confirm('Are you sure?')) return;

        fetch(`/progress/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => { document.getElementById('progress-' + id).remove(); alert('Progress deleted successfully!'); });
    }
</script>

@endsection
