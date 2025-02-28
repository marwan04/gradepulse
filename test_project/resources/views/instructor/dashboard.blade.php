@extends('layouts.app')

@section('title', 'Instructor Dashboard')

@section('content')
    <div class="container mt-5">
        <h2 class="text-primary">📊 Instructor Dashboard</h2>
        <p>Welcome, {{ Auth::user()->name }}! This is your instructor dashboard.</p>
    </div>
@endsection

