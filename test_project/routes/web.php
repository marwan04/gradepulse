<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InstructorController;

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
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:student'])->group(function () {
    Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

/*
|--------------------------------------------------------------------------
| Instructor Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:instructor'])->group(function () {
    Route::get('/instructor-dashboard', [InstructorDashboardController::class, 'index'])->name('instructor.dashboard');
    
    // Course Management
    Route::resource('instructor/courses', CourseController::class)->names([
        'index' => 'instructor.courses.index',
        'create' => 'instructor.courses.create',
        'store' => 'instructor.courses.store',
        'edit' => 'instructor.courses.edit',
        'update' => 'instructor.courses.update',
        'destroy' => 'instructor.courses.destroy',
    ]);

    // Section Management
    Route::resource('instructor/sections', SectionController::class)->names([
        'index' => 'instructor.sections.index',
        'create' => 'instructor.sections.create',
        'store' => 'instructor.sections.store',
        'edit' => 'instructor.sections.edit',
        'update' => 'instructor.sections.update',
        'destroy' => 'instructor.sections.destroy',
    ]);
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by Admin Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:instructor', 'admin'])->group(function () { // ✅ Ensure Admin Middleware is applied
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Course Management
    Route::resource('admin/courses', CourseController::class)->names([
        'index' => 'admin.courses.index',
        'create' => 'admin.courses.create',
        'store' => 'admin.courses.store',
        'edit' => 'admin.courses.edit',
        'update' => 'admin.courses.update',
        'destroy' => 'admin.courses.destroy',
    ]);

    // Instructor Management
    Route::resource('admin/instructors', InstructorController::class)->names([
        'index' => 'admin.instructors.index',
        'create' => 'admin.instructors.create',
        'store' => 'admin.instructors.store',
        'edit' => 'admin.instructors.edit',
        'update' => 'admin.instructors.update',
        'destroy' => 'admin.instructors.destroy',
    ]);

    // Section Management
    Route::resource('admin/sections', SectionController::class)->names([
        'index' => 'admin.sections.index',
        'create' => 'admin.sections.create',
        'store' => 'admin.sections.store',
        'edit' => 'admin.sections.edit',
        'update' => 'admin.sections.update',
        'destroy' => 'admin.sections.destroy',
    ]);
});

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

