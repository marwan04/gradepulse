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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// ✅ Login & Register Routes
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
Route::get('/student-dashboard', function () {
    if (!Auth::guard('student')->check()) {
        return redirect('/login')->with('error', 'Access denied.');
    }
    return app(StudentDashboardController::class)->index();
})->name('student.dashboard');

/*
|--------------------------------------------------------------------------
| Instructor Routes (Manual Authentication)
|--------------------------------------------------------------------------
*/
Route::get('/instructor-dashboard', function () {
    $user = Auth::guard('instructor')->user();
    if (!$user) {
        return redirect('/login')->with('error', 'Access denied.');
    }
    return app(InstructorDashboardController::class)->index();
})->name('instructor.dashboard');

// ✅ Upload Excel File (Instructor Only)
Route::post('/instructor/upload-excel', function () {
    $user = Auth::guard('instructor')->user();
    if (!$user) {
        return redirect('/login')->with('error', 'Access denied.');
    }
    return app(InstructorController::class)->uploadExcel(request());
})->name('instructor.uploadExcel');

/*
|--------------------------------------------------------------------------
| Admin Routes (Manual Role Verification)
|--------------------------------------------------------------------------
*/
Route::get('/admin-dashboard', function () {
    $user = Auth::guard('instructor')->user();
    if (!$user || $user->RoleID != 1) {
        return redirect('/instructor-dashboard')->with('error', 'Access denied.');
    }
    return app(AdminDashboardController::class)->index();
})->name('admin.dashboard');

Route::group(['prefix' => 'admin'], function () {
    // ✅ Manage Courses
    Route::resource('courses', CourseController::class)->except(['show'])->names([
        'index'   => 'admin.courses.index',
        'create'  => 'admin.courses.create',
        'store'   => 'admin.courses.store',
        'edit'    => 'admin.courses.edit',
        'update'  => 'admin.courses.update',
        'destroy' => 'admin.courses.destroy'
    ]);

    // ✅ Manage Sections
    Route::resource('sections', SectionController::class)->except(['show'])->names([
        'index'   => 'admin.sections.index',
        'create'  => 'admin.sections.create',
        'store'   => 'admin.sections.store',
        'edit'    => 'admin.sections.edit',
        'update'  => 'admin.sections.update',
        'destroy' => 'admin.sections.destroy'
    ]);

    // ✅ Manage Roles
    Route::resource('roles', RoleController::class)->except(['show'])->names([
        'index'   => 'admin.roles.index',
        'create'  => 'admin.roles.create',
        'store'   => 'admin.roles.store',
        'edit'    => 'admin.roles.edit',
        'update'  => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy'
    ]);

    // ✅ Manage Instructors
    Route::resource('instructors', InstructorController::class)->except(['show'])->names([
        'index'   => 'admin.instructors.index',
        'create'  => 'admin.instructors.create',
        'store'   => 'admin.instructors.store',
        'edit'    => 'admin.instructors.edit',
        'update'  => 'admin.instructors.update',
        'destroy' => 'admin.instructors.destroy'
    ]);

    // ✅ Manage Students
    Route::resource('students', StudentController::class)->except(['show'])->names([
        'index'   => 'admin.students.index',
        'create'  => 'admin.students.create',
        'store'   => 'admin.students.store',
        'edit'    => 'admin.students.edit',
        'update'  => 'admin.students.update',
        'destroy' => 'admin.students.destroy'
    ]);

    // ✅ Manage Plans
    Route::resource('plans', PlanController::class)->except(['show'])->names([
        'index'   => 'admin.plans.index',
        'create'  => 'admin.plans.create',
        'store'   => 'admin.plans.store',
        'edit'    => 'admin.plans.edit',
        'update'  => 'admin.plans.update',
        'destroy' => 'admin.plans.destroy'
    ]);

    // ✅ Manage Enrollments (NEW)
    Route::resource('enrollments', EnrollmentController::class)->except(['show'])->names([
        'index'   => 'admin.enrollments.index',
        'create'  => 'admin.enrollments.create',
        'store'   => 'admin.enrollments.store',
        'edit'    => 'admin.enrollments.edit',
        'update'  => 'admin.enrollments.update',
        'destroy' => 'admin.enrollments.destroy'
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

