<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentProgressController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [CustomAuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [CustomRegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Student Routes (Protected by 'auth:student' Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:student'])->group(function () {
    Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

/*
|--------------------------------------------------------------------------
| Instructor Routes (Protected by 'auth:instructor' Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:instructor'])->group(function () {
    Route::get('/instructor-dashboard', [InstructorDashboardController::class, 'index'])->name('instructor.dashboard');

    // 🔹 Resource Routes for CRUD Operations (Auto-creates index, create, store, edit, update, destroy)
    Route::resource('instructor/courses', CourseController::class);
    Route::resource('instructor/sections', SectionController::class);
    Route::resource('instructor/enrollments', EnrollmentController::class);
    Route::resource('instructor/plans', PlanController::class);
    Route::resource('instructor/roles', RoleController::class);
    Route::resource('instructor/progress', StudentProgressController::class);
    Route::resource('instructor/teams', TeamController::class);
});

/*
|--------------------------------------------------------------------------
| Logout Route (Fix: Use Auth::logout Properly)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
