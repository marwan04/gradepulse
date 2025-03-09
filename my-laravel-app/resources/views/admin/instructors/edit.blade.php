@extends('layouts.app')

@section('title', 'Edit Instructor')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold">✏️ Edit Instructor</h2>

        <!-- 🔙 Back Button -->
        <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary">⬅ Back to List</a>
    </div>

    <hr>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ✏️ Edit Instructor Form -->
    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('admin.instructors.update', $instructor->InstructorID) }}" method="POST" onsubmit="return validateEmail()">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="InstructorID" class="form-label fw-bold">Instructor ID</label>
                <input type="number" name="InstructorID" id="InstructorID" class="form-control" required value="{{ $instructor->InstructorID }}" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Instructor Name</label>
                <input type="text" name="Name" id="name" class="form-control" required value="{{ old('Name', $instructor->Name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email (Must be @instructordomain.com)</label>
                <input type="email" name="Email" id="email" class="form-control" required value="{{ old('Email', $instructor->Email) }}">
                <small class="text-muted">Example: example@instructordomain.com</small>
                <span id="emailError" class="text-danger" style="display: none;">Email must end with @instructordomain.com</span>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input type="text" name="Phone" id="phone" class="form-control" value="{{ old('Phone', $instructor->Phone) }}">
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label fw-bold">Role</label>
                <select name="RoleID" id="role_id" class="form-select" required>
                    <option value="">-- Select Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->RoleID }}" {{ $instructor->RoleID == $role->RoleID ? 'selected' : '' }}>
                            {{ $role->RoleName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">💾 Save Changes</button>
        </form>
    </div>
</div>

<script>
    function validateEmail() {
        var emailInput = document.getElementById("email").value;
        var emailError = document.getElementById("emailError");

        if (!emailInput.endsWith("@instructordomain.com")) {
            emailError.style.display = "block";
            return false;
        } else {
            emailError.style.display = "none";
            return true;
        }
    }
</script>

@endsection

