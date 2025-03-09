@extends('layouts.app')

@section('title', 'Manage Roles')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">🎭 Manage Roles</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <hr>

    <!-- 🔵 Add Role Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">➕ Add New Role</a>
    </div>

    <!-- 📋 Roles Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>Role ID</th>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($roles as $role)
                    <tr>
                        <td><strong>{{ $role->RoleID }}</strong></td>
                        <td>{{ $role->RoleName }}</td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
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
</div>

@endsection

