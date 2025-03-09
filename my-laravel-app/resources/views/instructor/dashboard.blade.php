@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')

<style>
    /* Hide navbar */
    nav.navbar {
        display: none !important;
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-primary">📊 Instructor Dashboard</h2>

        <!-- 🔴 Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">🚪 Logout</button>
        </form>
    </div>

    <hr>

    <!-- 🏫 Instructor Welcome Message -->
    @if(Auth::guard('instructor')->check())
        <p>Welcome, <strong>{{ Auth::guard('instructor')->user()->name }}</strong>! This is your instructor dashboard.</p>
    @else
        <p>Welcome, Guest! Please log in.</p>
    @endif

    <hr>

    <!-- 🔹 Quick Actions -->
    <div class="mt-4">
        <h4 class="fw-bold">🔗 Quick Actions</h4>
        <div class="d-flex flex-wrap">
            <!-- ✅ Manage Sections -->
            <a href="{{ route('instructor.sections.index') }}" class="btn btn-outline-primary m-2">📑 Manage My Sections</a>

            <!-- ✅ Upload Excel -->
            <form action="{{ route('instructor.uploadExcel') }}" method="POST" enctype="multipart/form-data" class="border p-3 rounded">
                @csrf
                <label for="file" class="form-label">📂 Upload Excel File:</label>
                <input type="file" name="file" id="file" class="form-control mb-2" required>
                <button type="submit" class="btn btn-primary">📤 Upload File</button>
            </form>

            <!-- ✅ Edit Student Marks -->
            <a href="{{ route('instructor.enrollments.index') }}" class="btn btn-success m-2">✏️ Edit Student Marks</a>
        </div>
    </div>
</div>

@endsection

