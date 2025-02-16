<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController; // Ensure CourseController is properly imported
use App\Http\Controllers\SectionController;

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

    // ✅ Properly namespaced Course Management Routes
    Route::resource('instructor/courses', CourseController::class)->names([
        'index' => 'instructor.courses.index',
        'create' => 'instructor.courses.create',
        'store' => 'instructor.courses.store',
        'edit' => 'instructor.courses.edit',
        'update' => 'instructor.courses.update',
        'destroy' => 'instructor.courses.destroy',
    ]);
    // ✅ Section Management
    Route::resource('instructor/sections', SectionController::class)->names([
        'index' => 'instructor.sections.index',
        'create' => 'instructor.sections.create',
        'store' => 'instructor.sections.store',
        'edit' => 'instructor.sections.edit',
        'update' => 'instructor.sections.update',
        'destroy' => 'instructor.sections.destroy',
    ]);
    // ✅ Enrollment Management
    /*Route::resource('instructor/enrollments', InstructorController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ])->names([
        'index' => 'instructor.enrollments',
        'store' => 'instructor.enrollments.store',
        'update' => 'instructor.enrollments.update',
        'destroy' => 'instructor.enrollments.destroy',
    ]);

    // ✅ Plan Management
    Route::resource('instructor/plans', InstructorController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ])->names([
        'index' => 'instructor.plans',
        'store' => 'instructor.plans.store',
        'update' => 'instructor.plans.update',
        'destroy' => 'instructor.plans.destroy',
    ]);

    // ✅ Role Management
    Route::resource('instructor/roles', InstructorController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ])->names([
        'index' => 'instructor.roles',
        'store' => 'instructor.roles.store',
        'update' => 'instructor.roles.update',
        'destroy' => 'instructor.roles.destroy',
    ]);

    // ✅ Student Progress Management
    Route::resource('instructor/progress', InstructorController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ])->names([
        'index' => 'instructor.progress',
        'store' => 'instructor.progress.store',
        'update' => 'instructor.progress.update',
        'destroy' => 'instructor.progress.destroy',
    ]);

    // ✅ Team Management
    Route::resource('instructor/teams', InstructorController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ])->names([
        'index' => 'instructor.teams',
        'store' => 'instructor.teams.store',
        'update' => 'instructor.teams.update',
        'destroy' => 'instructor.teams.destroy',
    ]);*/
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

