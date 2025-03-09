@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">✏️ Edit Role</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">⬅ Back to Roles</a>
    </div>

    <hr>

    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
        @csrf
        @method('PUT')

        <!-- Role ID (Read-Only) -->
        <div class="mb-3">
            <label class="form-label fw-bold">Role ID</label>
            <input type="number" class="form-control" name="RoleID" value="{{ $role->RoleID }}" readonly>
        </div>

        <!-- Role Name -->
        <div class="mb-3">
            <label class="form-label fw-bold">Role Name</label>
            <input type="text" class="form-control" name="RoleName" value="{{ $role->RoleName }}" required>
        </div>

        <!-- ✅ Update Button -->
        <button type="submit" class="btn btn-success">✅ Update Role</button>
    </form>
</div>

@endsection

