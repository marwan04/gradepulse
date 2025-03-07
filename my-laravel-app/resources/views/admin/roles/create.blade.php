@extends('layouts.app')

@section('title', 'Add New Role')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">➕ Add New Role</h2>
    <hr>

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Role ID</label>
            <input type="number" class="form-control" name="RoleID" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Role Name</label>
            <input type="text" class="form-control" name="RoleName" required>
        </div>

        <button type="submit" class="btn btn-primary">✅ Create Role</button>
    </form>
</div>
@endsection

