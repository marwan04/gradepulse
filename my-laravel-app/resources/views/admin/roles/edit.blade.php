@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">✏️ Edit Role</h2>
    <hr>

    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Role ID</label>
            <input type="number" class="form-control" name="RoleID" value="{{ $role->RoleID }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Role Name</label>
            <input type="text" class="form-control" name="RoleName" value="{{ $role->RoleName }}" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Update Role</button>
    </form>
</div>
@endsection

