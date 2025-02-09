@extends('layouts.app')

@section('title', 'Manage Sections')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Sections</h2>
    <div class="card p-4 mb-4">
        <h4>Add New Section</h4>
        <form id="add-section-form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Section Name</label>
                <input type="text" name="name" id="section-name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Section</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Existing Sections</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sections-list">
                @foreach($sections as $section)
                <tr id="section-{{ $section->id }}">
                    <td><input type="text" class="form-control" value="{{ $section->name }}" id="name-{{ $section->id }}"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="updateSection({{ $section->id }})">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteSection({{ $section->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-section-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('{{ route("sections.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        }).then(response => response.json()).then(() => { alert('Section added successfully!'); location.reload(); });
    });

    function updateSection(id) {
        let name = document.getElementById('name-' + id).value;

        fetch(`/sections/update/${id}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ name })
        }).then(response => response.json()).then(() => alert('Section updated successfully!'));
    }

    function deleteSection(id) {
        if (!confirm('Are you sure?')) return;

        fetch(`/sections/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => { document.getElementById('section-' + id).remove(); alert('Section deleted successfully!'); });
    }
</script>

@endsection
