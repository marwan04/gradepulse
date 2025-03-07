@extends('layouts.app')

@section('title', 'Add New Instructor')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">➕ Add New Instructor</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary mb-3">⬅ Back to List</a>

    <form action="{{ route('admin.instructors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="InstructorID" class="form-label">Instructor ID</label>
            <input type="number" name="InstructorID" id="InstructorID" class="form-control" required value="{{ old('InstructorID') }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Instructor Name</label>
            <input type="text" name="Name" id="name" class="form-control" required value="{{ old('Name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (Must be @instructordomain.com)</label>
            <input type="email" name="Email" id="email" class="form-control" required value="{{ old('Email') }}">
            <small class="text-muted">Example: example@instructordomain.com</small>
            <span id="emailError" class="text-danger" style="display: none;">Email must end with @instructordomain.com</span>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="Phone" id="phone" class="form-control" value="{{ old('Phone') }}">
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="RoleID" id="role_id" class="form-control" required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->RoleID }}" {{ old('RoleID') == $role->RoleID ? 'selected' : '' }}>
                        {{ $role->RoleName }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Default Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Default Password (Auto-Set)</label>
            <input type="text" name="Password" id="password" class="form-control" value="Default123!" readonly>
        </div>

        <button type="submit" class="btn btn-success">✅ Add Instructor</button>
    </form>
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

