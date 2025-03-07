@extends('layouts.app')

@section('title', 'Manage Roles')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Roles</h2>

    <div class="card p-4 mb-4">
        <h4>Add New Role</h4>
        <form id="add-role-form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" name="name" id="role-name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Role</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Existing Roles</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="roles-list">
                @foreach($roles as $role)
                <tr id="role-{{ $role->id }}">
                    <td><input type="text" class="form-control" value="{{ $role->name }}" id="name-{{ $role->id }}"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="updateRole({{ $role->id }})">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRole({{ $role->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-role-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('{{ route("roles.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        }).then(response => response.json()).then(() => { alert('Role added successfully!'); location.reload(); });
    });

    function updateRole(id) {
        let name = document.getElementById('name-' + id).value;

        fetch(`/roles/update/${id}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ name })
        }).then(response => response.json()).then(() => alert('Role updated successfully!'));
    }

    function deleteRole(id) {
        if (!confirm('Are you sure?')) return;

        fetch(`/roles/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => { document.getElementById('role-' + id).remove(); alert('Role deleted successfully!'); });
    }
</script>

@endsection
