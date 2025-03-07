@extends('layouts.app')

@section('title', 'Manage Roles')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">🎭 Manage Roles</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">➕ Add New Role</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role ID</th>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->RoleID }}</td>
                    <td>{{ $role->RoleName }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

