<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\CustomRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login'); // Or your custom login view
})->name('login');

Route::post('/login', [CustomAuthController::class, 'login']);

Route::middleware(['auth:student'])->group(function () {
    Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

Route::middleware(['auth:instructor'])->group(function () {
    Route::get('/instructor-dashboard', [InstructorDashboardController::class, 'index'])->name('instructor.dashboard');
});

Route::get('/register', function () {
    return view('auth.register'); // Keep the default registration form
})->name('register');

Route::post('/register', [CustomRegisterController::class, 'register']);
