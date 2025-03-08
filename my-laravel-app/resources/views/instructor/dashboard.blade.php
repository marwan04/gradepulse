@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary">📊 Instructor Dashboard</h2>

        @if(Auth::guard('instructor')->check())
            <p>Welcome, {{ Auth::guard('instructor')->user()->name }}! This is your instructor dashboard.</p>
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

