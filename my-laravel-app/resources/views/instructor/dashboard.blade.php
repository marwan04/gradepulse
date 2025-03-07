@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary">📊 Instructor Dashboard</h2>

        @if(Auth::check() && isset(Auth::user()->name))
            <p>Welcome, {{ Auth::user()->name }}! This is your instructor dashboard.</p>
        @else
            <p>Welcome, Guest! Please log in.</p>
        @endif

        <!-- نموذج رفع ملف إكسل -->
        <div class="mt-4">
            <form action="{{ route('instructor.uploadExcel') }}" method="POST" enctype="multipart/form-data" class="border p-3 rounded">
                @csrf
                <label for="file" class="form-label">📂 اختر ملف الإكسل:</label>
                <input type="file" name="file" id="file" class="form-control mb-2" required>
                <button type="submit" class="btn btn-primary">📤 رفع الملف</button>
            </form>
        </div>
    </div>
@endsection

