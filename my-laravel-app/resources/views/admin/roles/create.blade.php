@extends('layouts.app')

@section('title', 'Add New Role')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">➕ Add New Role</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">⬅ Back to Roles</a>
    </div>

    <hr>

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <!-- Role ID -->
        <div class="mb-3">
            <label class="form-label fw-bold">Role ID</label>
            <input type="number" class="form-control" name="RoleID" required>
        </div>

        <!-- Role Name -->
        <div class="mb-3">
            <label class="form-label fw-bold">Role Name</label>
            <input type="text" class="form-control" name="RoleName" required>
        </div>

        <!-- ✅ Create Button -->
        <button type="submit" class="btn btn-primary">✅ Create Role</button>
    </form>
</div>

@endsection

