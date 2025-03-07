@extends('layouts.app')

@section('title', 'Manage Courses')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Courses</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Course Form -->
    <div class="card p-4 mb-4">
        <h4>Add New Course</h4>
        <form id="add-course-form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" name="name" id="course-name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="course-description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>
    </div>

    <!-- Courses List Table -->
    <div class="card p-4">
        <h4>Existing Courses</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="courses-list">
                @foreach($courses as $course)
                <tr id="course-{{ $course->id }}">
                    <td>
                        <input type="text" class="form-control" value="{{ $course->name }}" id="name-{{ $course->id }}">
                    </td>
                    <td>
                        <input type="text" class="form-control" value="{{ $course->description }}" id="description-{{ $course->id }}">
                    </td>
                    <td>
                        <!-- Update Button -->
                        <button class="btn btn-warning btn-sm" onclick="updateCourse({{ $course->id }})">Update</button>

                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm" onclick="deleteCourse({{ $course->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for Handling AJAX Requests -->
<script>
    document.getElementById('add-course-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        
        fetch('{{ route("courses.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Course added successfully!');
                location.reload();
            } else {
                alert('Error adding course.');
            }
        });
    });

    function updateCourse(id) {
        let name = document.getElementById('name-' + id).value;
        let description = document.getElementById('description-' + id).value;

        fetch(`/courses/update/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, description })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert('Course updated successfully!');
              } else {
                  alert('Error updating course.');
              }
          });
    }

    function deleteCourse(id) {
        if (!confirm('Are you sure you want to delete this course?')) return;

        fetch(`/courses/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('course-' + id).remove();
                alert('Course deleted successfully!');
            } else {
                alert('Error deleting course.');
            }
        });
    }
</script>

@endsection
